<?php

/**
 * QueryFilter
 * php version 7.1
 *
 * @category Eloquent
 * @package  Laravel
 * @author   Faisal Ahmed <hello@imfaisal.me>
 * @license  http://license.imfaisal.me/public Public
 * @link     http://imfaisal.me/ Faisal Ahmed
 */

namespace Faisal50x\QueryFilter;

use Throwable;
use ReflectionMethod;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;

/**
 * Abstract QueryFilter class
 *
 * @category Eloquent\Builder
 * @package  Laravel
 * @author   Faisal Ahmed <hello@imfaisal.me>
 * @license  http://license.imfaisal.me/private Private Use
 * @link     http://imfaisal.me Faisal Ahmed
 */
abstract class QueryFilter
{

    /**
     * Eloquent Builder instance
     *
     * @var Builder  $builder
     */
    private $builder;

    /**
     * Illuminate http request
     *
     * @var Request $request
     */
    private $request;

    /**
     * Append all query string
     *
     * @var array $appends
     */
    private $appends = [];

    /**
     * Skip executing listed method
     *
     * @var array $reservedMethods
     */
    private $reservedMethods = ['query', 'apply', 'callDefaultFn'];

    private $deferedMethods = ['order', 'orderBy', 'sort', 'sortBy'];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * get query string from url
     *
     * @return array
     */
    public function query(): array
    {
        return $this->request->query();
    }

    public function apply(Builder $builder)
    {
        //Reset appended query string
        $this->appends = [];

        //Initialize Eloquent builder instance
        $this->setBuilder($builder);

        //call function which has a default value but not exist in query string
        $this->callDefaultFn();

        foreach ($this->query() as $name => $value) {
            if (
                method_exists($this, Str::camel($name))
                && !in_array(Str::camel($name), $this->skipToCall())
            ) {
                $this->appends[$name] = $value;
                $params = is_array($value) ? $value : explode(',', $value);
                $params = Arr::wrap($params);
                array_unshift($params, $this->builder);
                call_user_func_array(
                    [$this, Str::camel($name)],
                    $params
                    //array_filter($params)
                );
            }
        }
        return $this->builder;
    }

    public function setBuilder(Builder $builder)
    {
        $this->builder = $builder;
    }

    private function callDefaultFn()
    {
        foreach (get_class_methods($this) as $method) {
            try {
                $that = new ReflectionMethod($this, $method);
            } catch (Throwable $exception) {
                break;
            }
            if (
                $that->isProtected()
                && !in_array($method, $this->query())
                && !in_array($method, $this->skipToCall())
            ) {
                $this->{$method}($this->builder);
            }
        }
    }

    private function skipToCall(): array
    {
        return array_merge(
            $this->reservedMethods,
            $this->deferedMethods
        );
    }

    /**
     * @return array
     */
    public function getAppendedQueryStrings(): array
    {
        return $this->appends;
    }
}
