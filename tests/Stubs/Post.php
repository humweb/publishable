<?php

namespace Humweb\Tests\Publishable\Stubs;

use Humweb\Publishable\Publishable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Post
 *
 * @package Humweb\Tests\Publishable\Stubs
 */
class Post extends Model
{

    use Publishable;

    static $publishableScopeDisabled = false;

    protected $table = 'posts';

    protected $fillable = [
        'title',
        'content',
        'published_on',
    ];

    protected $dates = [
        'published_on'
    ];

}
