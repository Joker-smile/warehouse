<?php

namespace App\Contracts\Repositories;

interface CriteriaInterface
{
    /**
     * Apply criteria in query repository.
     *
     * @param mixed                                           $model      The model
     * @param \App\Contracts\Repositories\RepositoryInterface $repository The repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository);
}
