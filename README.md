# Publishable Trait
[![pipeline status](https://gitlab.com/Humboldtweb/publishable/badges/master/pipeline.svg)](https://gitlab.com/Humboldtweb/publishable/commits/master)
[![coverage report](https://gitlab.com/Humboldtweb/publishable/badges/master/coverage.svg)](https://gitlab.com/Humboldtweb/publishable/commits/master)
## Install

Via Composer

``` bash
$ composer require humweb/publishable
```

## Testing

``` bash
$ phpunit
```

## Defaults and assumptions

### Global scope
* The `published()` scope is added by default.
* To disable the global scope define this static property in your model `$publishableScopeDisabled = true;`

### Database column 
* The database column type must be `timestamp`.
* The default database column name is `published_at`. However you may override the column name by defining `$publishableField` property on your model. 


## Setup model
```php
use Illuminate\Database\Eloquent\Model;
use Humweb\Publishable\Publishable;

class Post extends Model
{
    use Publishable;
    
    // Optional property to override default column name
    protected $publishableField = 'published_on';
}
```

## Model helpers

### Publish model
```
$post->publish();
```

### Unpublish model
```
$post->unpublish();
```

### Check if model is published
```
$post->isPublished();
```

### Check if model is not published
```
$post->isUnpublished();
```

## Query scopes
By default the `Publishable` trait will apply a global query scope to the model. 


### Unpublished models
```php
Post::unpublished()->get();
```

### Published models
This scope will be added by default to all queries. 
```php
Post::published()->get();
```



## Credits

- [Ryan Shofner][link-author]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
[link-author]: https://github.com/ryun
