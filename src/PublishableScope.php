<?php

namespace Humweb\Publishable;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class PublishableScope implements Scope
{

    /**
     * Apply scope to query
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @param  \Illuminate\Database\Eloquent\Model   $model
     *
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        if ($model->shouldApplyPublishableScope()) {
            $builder->published();
        }
    }

}