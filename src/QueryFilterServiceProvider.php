<?php

namespace Faisal50x\QueryFilter;

use Illuminate\Support\ServiceProvider;
use Faisal50x\QueryFilter\Queries\Filter;
use Faisal50x\QueryFilter\Queries\FilterPaginate;
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
            return (new Filter($this, $filter))();
        });
        EloquentBuilder::macro('filterPaginate', function ($perPage = null, $column = ['*'], $pageName = 'page', $page = null) {
            return (new FilterPaginate($this))($perPage, $column, $pageName, $page);
        });

        DatabaseBuilder::macro('filter', function (QueryFilter $filter) {
            return (new Filter($this, $filter))();
        });

        DatabaseBuilder::macro('filterPaginate', function ($perPage = null, $column = ['*'], $pageName = 'page', $page = null) {
            return (new FilterPaginate($this))($perPage, $column, $pageName, $page);
        });
    }
}
