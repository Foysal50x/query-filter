<?php


namespace Faisal50x\QueryFilter\Traits;


use Faisal50x\QueryFilter\QueryFilter;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
/**
 * User Filerable trait
 *
 * @category Eloquent
 * @package  Laravel
 * @author   Faisal Ahmed <hello@imfaisal.me>
 * @license  http://license.imfaisal.me/public Public
 * @link     http://imfaisal.me Faisal Ahmed
 */
trait Filterable {

    /**
     * @var QueryFilter $_self
     */
    private $_self;

    /**
     * @param Builder $builder
     * @param QueryFilter $filter
     * @return Builder
     */
    public function scopeFilter(Builder $builder, QueryFilter $filter)
    {
        $this->_self = $filter;
        return $filter->apply($builder);
    }

    /**
     * @param Builder $builder
     * @param int $perPage
     * @return LengthAwarePaginator|null
     */
    public function scopeFilterPaginate(Builder $builder, int $perPage):? LengthAwarePaginator
    {
        $paginate = $builder->paginate($perPage);
        $paginate->appends($this->_self->getAppendedQueryStrings())->links();
        return $paginate;
    }
}
