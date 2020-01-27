<?php
use Faisal50x\QueryFilter\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

class User extends Model {

    use Filterable;

    protected $guarded = [];
}
