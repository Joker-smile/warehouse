<?php

namespace App\Contracts\Repositories\Criterias;

use App\Contracts\Repositories\CriteriaInterface;
use App\Contracts\Repositories\RepositoryInterface;

class WhereCriteria implements CriteriaInterface
{
    protected $column;

    protected $operator;

    protected $value;

    protected $boolean;

    public function __construct($column, $operator = null, $value = null, $boolean = 'and')
    {
        $this->column = $column;

        $this->operator = $operator;

        $this->value = $value;

        $this->boolean = $boolean;
    }

    public function apply($model, RepositoryInterface $repository)
    {
        if ($this->operator == 'in') {
            return $model->whereIn($this->column, $this->value, $this->boolean);
        }

        if ($this->operator == 'between') {
            return $model->whereBetween($this->column, $this->value, $this->boolean);
        }

        return $model->where($this->column, $this->operator, $this->value, $this->boolean);
    }
}
