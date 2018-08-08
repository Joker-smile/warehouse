<?php

namespace App\Contracts\Repositories;

use Closure;

/**
 * Interface RepositoryInterface.
 */
interface RepositoryInterface
{
    /**
     * Retrieve all data of repository.
     *
     * @param array $columns
     *
     * @return mixed
     */
    public function all(array $columns = ['*']);

    /**
     * Retrieve all data of repository, paginated.
     *
     * @param null   $limit
     * @param array  $columns
     * @param string $type    either `paginate` or 'simplePaginate'
     *
     * @return mixed
     */
    public function paginate($limit = null, $columns = ['*'], $type = 'paginate');

    /**
     * Find data by id.
     *
     * @param       $id
     * @param array $columns
     *
     * @return mixed
     */
    public function find($id, $columns = ['*']);

    /**
     * find record by field and value.
     *
     * @param string $field   The field
     * @param mixed  $value   The value
     * @param array  $columns The columns
     */
    public function findBy(string $field, $value, $columns = ['*']);

    /**
     * Save a new entity in repository.
     *
     * @param array $attributes
     *
     * @return mixed
     */
    public function create(array $attributes);

    /**
     * Update a entity in repository by id.
     *
     * @param array $attributes
     * @param       $id
     *
     * @return mixed
     */
    public function update($id, array $attributes);

    /**
     * Delete entities.
     *
     * @param $id
     *
     * @return int
     */
    public function delete($id);

    /**
     * Order collection by a given column.
     *
     * @param string $column
     * @param string $direction
     *
     * @return $this
     */
    public function orderBy(string $column, string $direction = 'asc');

    /**
     * Load relations.
     *
     * @param $relations
     *
     * @return $this
     */
    public function with($relations);

    /**
     * Order results by date desc.
     *
     * @param string $column the column name to be sort by
     *
     * @return $this
     */
    public function latest(string $column = 'created_at');

    /**
     * To limit the number of results.
     *
     * @param int $count
     *
     * @return $this
     */
    public function take(int $count = 5);

    /**
     * Add subselect queries to count the relations.
     *
     * @param mixed $relations The relations
     *
     * @return $this
     */
    public function withCount($relations);

    /**
     * get the first result.
     *
     * @param array $columns The columns
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function first(array $columns = ['*']);

    /**
     * Load relation with closure.
     *
     * @param string  $relation
     * @param closure $closure
     *
     * @return $this
     */
    public function whereHas($relation, Closure $closure);

    /**
     * Add a join clause to the query.
     *
     * @param string $table
     * @param string $one
     * @param string $operator
     * @param string $two
     * @param string $type
     * @param bool   $where
     *
     * @return $this
     */
    public function join($table, $one, $operator = null, $two = null, $type = 'inner', $where = false);

    /**
     * Retrieve the "count" result of the query.
     *
     * @param string $columns
     *
     * @return int
     */
    public function count($columns = '*');
}
