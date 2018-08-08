<?php

namespace App\Contracts\Repositories;

/**
 * Interface RepositoryCriteriaInterface.
 */
interface RepositoryCriteriaInterface
{
    /**
     * Push Criteria for filter the query.
     *
     * @param $criteria
     *
     * @return $this
     */
    public function pushCriteria(CriteriaInterface $criteria);

    /**
     * Get Collection of Criteria.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getCriteria();

    /**
     * Skip Criteria.
     *
     * @param bool $status
     *
     * @return $this
     */
    public function skipCriteria();

    /**
     * Reset all Criteria.
     *
     * @return $this
     */
    public function resetCriteria();
}
