<?php

namespace App\Contracts\Repositories;

use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

abstract class AbstractRepository implements RepositoryInterface, RepositoryCriteriaInterface
{
    protected $model;

    protected $initModel;

    protected $criteria;

    protected $skipCriteria;

    public function __construct()
    {
        $this->init();
    }

    /**
     * return model name.
     *
     * @return string
     */
    abstract public function model();

    /**
     * init the repositoriy.
     */
    private function init()
    {
        $this->criteria     = new Collection();
        $this->skipCriteria = false;
        $this->make();
    }

    /**
     * get the table in database.
     *
     * @return     string  The table.
     */
    public function getTable()
    {
        return $this->model->getTable();
    }

    public function getKeyName()
    {
        return $this->model->getKeyName();
    }

    /**
     * init model.
     */
    public function make()
    {
        $this->model = $this->initModel = app($this->model());
    }

    /**
     * reset repository states.
     */
    public function reset()
    {
        $this->model = $this->initModel;

        $this->resetCriteria();
    }

    /**
     * return all records.
     *
     * @param array $columns
     *
     * @return mixed
     */
    public function all(array $columns = ['*'])
    {
        $this->applyCriteria();

        $results = $this->model->get($columns);

        $this->reset();

        return $results;
    }

    /**
     *  retrieve a Collection containing the values of a single column.
     *
     *  @param string $column column name
     *
     *  @return mixed
     */
    public function pluck(string $column)
    {
        $this->applyCriteria();

        $results = $this->model->pluck($column);

        $this->reset();

        return $results;
    }

    /**
     * find a record if exsiting
     * otherwise create new one.
     *
     * @param array $target matching attribute
     * @param array $data
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function firstOrCreate(array $target, array $data = [])
    {
        return $this->model->updateOrCreate($target, $data);
    }

    /**
     * update a record if exsiting
     * otherwise create new one.
     *
     * @param array $target matching attribute
     * @param array $date
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function updateOrCreate(array $target, array $data)
    {
        return $this->model->updateOrCreate($target, $data);
    }

    /**
     * get the first result.
     *
     * @param array $columns The columns
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException when not found
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function firstOrFail(array $columns = ['*'])
    {
        $this->applyCriteria();

        $result = $this->model->firstOrFail($columns);

        $this->reset();

        return $result;
    }

    /**
     * Order results by date desc.
     *
     * @param string $column the column name to be sort by
     *
     * @return $this
     */
    public function latest(string $column = 'created_at')
    {
        $this->model = $this->model->latest($column);

        return $this;
    }

    /**
     * To limit the number of results.
     *
     * @param int $count
     *
     * @return $this
     */
    public function take(int $count = 5)
    {
        $this->model = $this->model->take($count);

        return $this;
    }

    /**
     * get the first result.
     *
     * @param array $columns The columns
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function first(array $columns = ['*'])
    {
        $this->applyCriteria();

        $result = $this->model->first($columns);

        $this->reset();

        return $result;
    }

    /**
     * Retrieve the "count" result of the query.
     *
     * @param string $columns
     *
     * @return int
     */
    public function count($columns = '*')
    {
        $this->applyCriteria();

        $result = $this->model->count($columns);

        $this->reset();

        return $result;
    }

    /**
     * Add subselect queries to count the relations.
     *
     * @param mixed $relations The relations
     *
     * @return $this
     */
    public function withCount($relations)
    {
        if (!$relations) {
            return $this;
        }

        $this->model = $this->model->withCount($relations);

        return $this;
    }

    /**
     * eager load relations.
     *
     * @param mixed $relations
     *
     * @return $this
     */
    public function with($relations)
    {
        if (!$relations) {
            return $this;
        }

        if (!is_array($relations)) {
            $relations = [$relations];
        }

        $this->model = $this->model->with($relations);

        return $this;
    }

    /**
     * Order collection by a given column.
     *
     * @param string $column
     * @param string $direction
     *
     * @return $this
     */
    public function orderBy(string $column, string $direction = 'asc')
    {
        $this->model = $this->model->orderBy($column, $direction);

        return $this;
    }

    /**
     * Retrieve all data of repository.
     *
     * @param null            $limit
     * @param array           $columns
     * @param Function|string $type    The type
     *
     * @return mixed
     */
    public function paginate($limit = 15, $columns = ['*'], $type = 'paginate')
    {
        $this->applyCriteria();

        if (!in_array($type, ['paginate', 'simplePaginate'])) {
            $type = 'paginate';
        }

        $results = $this->model->$type($limit, $columns)->appends(request()->all());

        $this->reset();

        return $results;
    }

    /**
     * Update one or many records in the database.
     *
     * @param array $values
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update($id = null, array $data = [])
    {
        if ($id === null) {
            $this->applyCriteria();

            return $this->model->update($data);
        }

        $instance = $this->find($id);

        $instance->update($data);

        return $instance;
    }

    /**
     * create an instance with given data.
     *
     * @param array $data The data
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * find record by field and value.
     *
     * @param      string               $field    The field
     * @param      mixed                $value    The value
     * @param      array                $columns  The columns
     *
     * @throws     ModelNotFoundException  when model not found
     *
     * @return     Illuminate\Database\Eloquent\Model
     */
    public function findBy(string $field, $value, $columns = ['*'])
    {
        $this->applyCriteria();

        $instance = $this->model->where($field, $value)->firstOrFail();

        $this->reset();

        return $instance;
    }

    /**
     * find an instance with given id.
     *
     * @param mixed $id
     * @param array $columns The columns
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException when not found
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function find($id, $columns = ['*'])
    {
        $modelClass = get_class($this->initModel);

        $this->applyCriteria();

        if (is_object($id)) {
            $this->reset();

            //we'll just check if it's an instance of the model class
            //no need to check the primary key if they pass an instance.
            if (is_a($id, $modelClass)) {
                return $id;
            }

            throw (new ModelNotFoundException)->setModel(
                get_class($modelClass), 0
            );
        }

        $instance = $this->model->findOrFail($id, $columns);

        $this->reset();

        return $instance;
    }

    /**
     * delete models.
     *
     * @param array|string $id
     *
     * @return int
     */
    public function delete($id = null)
    {
        if ($id) {
            try {
                $model = $this->find($id);
            } catch (ModelNotFoundException $e) {
                return false;
            }

            return $model->delete();
        }

        $this->applyCriteria();

        return $this->model->delete();
    }

    /**
     * relation absence.
     *
     * @param string  $relation
     * @param closure $closure
     *
     * @return $this
     */
    public function whereDoesntHave($relation, Closure $closure)
    {
        $this->model = $this->model->whereDoesntHave($relation, $closure);

        return $this;
    }

    public function whereIn(array $keys)
    {

        if (!isset($keys[0])) {
            $key = key($keys);
            $ids = current($keys);
        } else {
            $key = $this->getKeyName();
            $ids = $keys;
        }

        $this->model = $this->model->whereIn($key, $ids);

        return $this;
    }

    /**
     * relation existence.
     *
     * @param string  $relation
     * @param closure $closure
     *
     * @return $this
     */
    public function whereHas($relation, Closure $closure)
    {
        $this->model = $this->model->whereHas($relation, $closure);

        return $this;
    }

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
    public function join($table, $one, $operator = null, $two = null, $type = 'inner', $where = false)
    {
        $this->model = $this->model->join($table, $one, $operator, $two, $type, $where);

        return $this;
    }

    /**
     * Push Criteria for filter the query.
     *
     * @param $criteria
     *
     * @return $this
     */
    public function pushCriteria(CriteriaInterface $criteria)
    {
        $this->criteria->push($criteria);
    }

    /**
     * Get Collection of Criteria.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getCriteria()
    {
        return $this->criteria;
    }

    /**
     * Skip Criteria.
     *
     * @param bool $status
     *
     * @return $this
     */
    public function skipCriteria()
    {
        $this->skipCriteria = true;

        return $this;
    }

    /**
     * Reset all Criteria.
     *
     * @return $this
     */
    public function resetCriteria()
    {
        $this->criteria = new Collection();

        return $this;
    }

    /**
     * apply query criterias.
     */
    protected function applyCriteria()
    {
        if ($this->skipCriteria === true) {
            return $this;
        }

        foreach ($this->criteria as $criteria) {
            $this->model = $criteria->apply($this->model, $this);
        }
    }

    public function __clone()
    {
        $this->init();
    }
}
