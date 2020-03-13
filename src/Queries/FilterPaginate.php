<?php

namespace Faisal50x\QueryFilter\Queries;

use Illuminate\Database\Query\Builder;

class FilterPaginate
{

    protected $builder;

    protected $arguments;

    public function __construct(Builder $builder, ...$args)
    {
        $this->builder = $builder;
        $this->arguments = $args;
    }

    public function __invoke()
    {
        return;
    }
}
