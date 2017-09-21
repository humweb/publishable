<?php

namespace Humweb\Tests\Publishable\Stubs;

use Humweb\Publishable\Publishable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Page
 *
 * @package Humweb\Tests\Publishable\Stubs
 */
class Page extends Model
{

    use Publishable;

    static $publishableScopeDisabled = false;

    protected $table = 'pages';

    protected $fillable = [
        'title',
        'content',
        'published_at',
    ];

    protected $dates = [
        'published_at'
    ];

}
