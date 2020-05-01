<?php

namespace Faisal50x\QueryFilter;

use Illuminate\Support\ServiceProvider;
use Faisal50x\QueryFilter\Queries\Filter;
use Illuminate\Database\Query\Builder as DatabaseBuilder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

class QueryFilterServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        EloquentBuilder::macro('filter', function (QueryFilter $filter) {
            return (new Filter($this->query, $filter))();
        });

        DatabaseBuilder::macro('filter', function (QueryFilter $filter) {
            return (new Filter($this, $filter))();
        });
    }
}
