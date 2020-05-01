<?php

namespace Faisal50x\QueryFilter\Queries;

use Faisal50x\QueryFilter\QueryFilter;
use Illuminate\Database\Query\Builder as QBuilder;
use Illuminate\Database\Eloquent\Builder as EBuilder;

class Filter
{
    /**
     * @var EBuilder|QBuilder $builder
     */
    protected $builder;

    /**
     * @var \Faisal50x\QueryFilter\QueryFilter $filter
     */
    protected $filter;

    /**
     * @param EBuilder|QBuilder $builder
     */
    public function __construct($builder, QueryFilter $filter)
    {
        $this->builder = $builder;
        $this->filter = $filter;
    }

    public function __invoke()
    {
        return $this->filter->apply($this->builder);
    }
}
