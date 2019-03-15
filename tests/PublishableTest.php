<?php

namespace Humweb\Tests\Publishable;

use Carbon\Carbon;
use Humweb\Tests\Publishable\Stubs\Page;

class PublishableTest extends TestCase
{
    protected $runMigrations = true;
    protected $page;


    /**
     * @test
     */
    public function it_returns_boolean_for_published_and_unpublished()
    {

        // Setup
        $page = factory(Page::class)->create([
            'published_at' => Carbon::now()->addDay()
        ]);

        // Unpublished
        $this->assertTrue($page->isUnpublished());
        $this->assertFalse($page->isPublished());
    }


    /**
     * @test
     */
    public function it_can_change_to_published_status()
    {

        // Setup
        $page = factory(Page::class)->create([
            'published_at' => Carbon::now()->addDay()
        ]);

        // Unpublished
        $this->assertTrue($page->isUnpublished());
        $this->assertFalse($page->isPublished());

        // Published
        $page->publish();
        $this->assertFalse($page->isUnpublished());
        $this->assertTrue($page->isPublished());
    }


    /**
     * @test
     */
    public function it_should_not_include_items_that_are_unpublished()
    {

        // Setup
        $page1 = factory(Page::class)->create([
            'published_at' => Carbon::now()->addDay()
        ]);
        $page2 = factory(Page::class)->create([
            'published_at' => Carbon::now()
        ]);
        $page3 = factory(Page::class)->create([
            'published_at' => Carbon::now()
        ]);
        $page4 = factory(Page::class)->create([
            'published_at' => null
        ]);

        // Unpublished
        $this->assertEquals(2, Page::count());

        // Global scope
        $pages = Page::all();
        $this->assertTrue($pages->contains($page2));
        $this->assertTrue($pages->contains($page3));
        $this->assertFalse($pages->contains($page1));
        $this->assertFalse($pages->contains($page4));

        // Get unpublished
        $pages = Page::unpublished()->get();
        $this->assertTrue($pages->contains($page1));
        $this->assertTrue($pages->contains($page4));

        // Test disable flag for global scope
        Page::$publishableScopeDisabled = true;
        $pages                          = Page::all();
        $this->assertTrue($pages->contains($page1));
        $this->assertTrue($pages->contains($page4));
        Page::$publishableScopeDisabled = false;
    }
}
