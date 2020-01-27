<?php


use Faisal50x\QueryFilter\QueryFilter;

class UserQueryFilter extends QueryFilter {

    public function userId($query, int $id = null)
    {
        if (empty($id)) return $query;

        return $query->whereId($id);
    }

    public function status($query, string $status = "active")
    {
        return $query->whereStatus($status);
    }

    public function isVerified($query, bool $param)
    {
        return $query->whereIsVarified($param);
    }
}
