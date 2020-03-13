<?php

namespace Faisal50x\QueryFilter\Queries;

use Faisal50x\QueryFilter\QueryFilter;
use Illuminate\Database\Query\Builder;

class Filter
{
    /**
     * @var \Illuminate\Database\Query\Builder $builder
     */
    protected $builder;

    /**
     * @var \Faisal50x\QueryFilter\QueryFilter $filter
     */
    protected $filter;

    public function __construct(Builder $builder, QueryFilter $filter)
    {
        $this->builder = $builder;
        $this->filter = $filter;
    }

    public function __invoke()
    {
        return $this->filter->apply($this->builder);
    }
}
