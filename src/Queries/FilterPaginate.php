<?php

namespace Faisal50x\QueryFilter\Queries;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QBuilder;

class FilterPaginate
{

    protected $builder;

    protected $arguments;

    /**
     * @var Builder|QBuilder $builder
     */
    public function __construct($builder, ...$args)
    {
        $this->builder = $builder;
        $this->arguments = $args;
    }

    public function __invoke()
    {
        return;
    }
}
