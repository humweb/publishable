<?php

$factory->define(\Humweb\Tests\Publishable\Stubs\Page::class, function (Faker\Generator $faker) {
    return [
        'title'        => $faker->text(25),
        'content'      => $faker->text,
        'published_at' => null
    ];
});

$factory->define(\Humweb\Tests\Publishable\Stubs\Post::class, function (Faker\Generator $faker) {
    return [
        'title'        => $faker->text(25),
        'content'      => $faker->text,
        'published_on' => null
    ];
});
