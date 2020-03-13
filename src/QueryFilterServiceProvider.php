<?php

namespace Faisal50x\QueryFilter;

use Illuminate\Support\ServiceProvider;
use Faisal50x\QueryFilter\Queries\Filter;
use Illuminate\Database\Query\Builder as DatabaseBuilder;

class QueryFilterServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        DatabaseBuilder::macro('filter', function (QueryFilter $filter) {
            return (new Filter($this, $filter))();
        });
    }
}
