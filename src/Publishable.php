<?php

namespace Humweb\Publishable;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

trait Publishable
{

    protected $internalPublishableField = null;


    /**
     * Add global scope
     */
    protected static function bootPublishable()
    {
        static::addGlobalScope(new PublishableScope());
    }


    /**
     * Scope query by published items
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished(Builder $query)
    {
        return $query->where(function ($query) {
            $query->where($this->getPublishableField(), '<=', Carbon::now())->whereNotNull($this->getPublishableField());
        });
    }


    /**
     * Scope query by unpublished items
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUnpublished(Builder $query)
    {
        return $query->withoutGlobalScope(PublishableScope::class)->where(function ($query) {
                $query->where($this->getPublishableField(), '>=', Carbon::now())->orWhereNull($this->getPublishableField());
        });
    }


    /**
     * Is published helper
     *
     * @return bool
     */
    public function isPublished()
    {
        return ( ! is_null($this->getAttribute($this->getPublishableField())))
            ? $this->getAttribute($this->getPublishableField())->lte(Carbon::now())
            : false;
    }


    /**
     * Is unpublished helper
     *
     * @return bool
     */
    public function isUnpublished()
    {
        return ! $this->isPublished();
    }


    /**
     * Publish model
     *
     * @return bool
     */
    public function publish()
    {
        return $this->update([$this->getPublishableField() => Carbon::now()]);
    }


    /**
     * Unpublish model
     *
     * @param null|Carbon $date
     *
     * @return mixed
     */
    public function unpublish($date = null)
    {
        return $this->update([$this->getPublishableField() => $date]);
    }


    /**
     * Get database column used for published date
     *
     * @return string
     */
    public function getPublishableField()
    {
        if (is_null($this->internalPublishableField)) {
            $this->internalPublishableField = (property_exists($this, 'publishableField'))
                ? $this->publishableField
                : 'published_at';
        }
        return $this->internalPublishableField;
    }

    function shouldApplyPublishableScope()
    {
        if (property_exists(static::class, 'publishableScopeDisabled')) {
            return static::$publishableScopeDisabled === false;
        }
        return true;
    }
}