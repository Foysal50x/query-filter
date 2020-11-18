<?php

namespace Faisal50x\QueryFilter\Queries;

use Illuminate\Support\Facades\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QBuilder;

class FilterPaginate
{
    /**
     * @var Builder|QBuilder $builder
     */
    protected $builder;


    /**
     * @var Builder|QBuilder $builder
     */
    public function __construct($builder)
    {
        $this->builder = $builder;
    }

    public function __invoke($perPage = null, $column = ['*'], $pageName = 'page', $page = null)
    {
        $paginate = $this->builder->paginate($perPage, $column, $pageName, $page);
        $paginate->appends(Request::query())->links();
        return $paginate;
    }
}
