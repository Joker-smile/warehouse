<?php

namespace App\Contracts\Traits;

use Illuminate\Database\Eloquent\Collection;

trait WhereInTrait
{
    public function whereIn(array $keys, array $columns = ['*']) : Collection
    {
        $repos = $this->whereInRepos();

        $repos->reset();

        return $repos->whereIn($keys)->all($columns);
    }

    public function whereInRepos()
    {
        if (isset($this->whereInRepos)) {
            return $this->whereInRepos;
        }

        throw new \BadMethodCallException("Not implemented yet");
    }
}