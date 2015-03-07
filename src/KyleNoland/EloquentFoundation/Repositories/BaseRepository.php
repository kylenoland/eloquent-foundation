<?php namespace KyleNoland\EloquentFoundation\Repositories;

use Illuminate\Database\Eloquent\Builder;
use KyleNoland\EloquentFoundation\Contracts\BaseRepositoryInterface;

abstract class BaseRepository implements BaseRepositoryInterface {

	/**
	 * Eloquent model
	 *
	 * @var \Illuminate\Database\Eloquent\Model
	 */
	protected $model;


	/**
	 * Query builder instance
	 *
	 * @var \Illuminate\Database\Eloquent\Builder
	 */
	protected $query;


	/**
	 * Get all the models
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public function all()
	{
		return $this->get();
	}


	/**
	 * Count the specified models
	 *
	 * @return int
	 */
	public function count()
	{
		return $this->get()->count();
	}


	/**
	 * Create a new model
	 *
	 * @param array $data
	 *
	 * @return \Illuminate\Database\Eloquent\Model
	 */
	public function create(array $data)
	{
		$this->query = null;

		return $this->model->create($data);
	}


	/**
	 * Delete models
	 *
	 * @return mixed
	 */
	public function delete()
	{
		$result = $this->query()->delete();

		$this->query = null;

		return $result;
	}


	/**
	 * Delete the specified model
	 *
	 * @param int $id
	 *
	 * @return int
	 */
	public function deleteById($id)
	{
		$this->query = null;

		return $this->model->destroy($id);
	}


	/**
	 * Delete the specified models
	 *
	 * @param array $ids
	 *
	 * @return int
	 */
	public function deleteMultipleById(array $ids)
	{
		$this->query = null;

		return $this->model->destroy($ids);
	}


	/**
	 * Get the first specified model record from the database
	 *
	 * @return \Illuminate\Database\Eloquent\Model
	 */
	public function first()
	{
		$model = $this->query()->first();

		$this->query = null;

		return $model;
	}


	/**
	 * Get the specified models
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public function get()
	{
		$models = $this->query()->get();

		$this->query = null;

		return $models;
	}


	/**
	 * Get the specified model
	 *
	 * @param int $id
	 *
	 * @return \Illuminate\Database\Eloquent\Model
	 */
	public function getById($id)
	{
		$model = $this->query()->findOrFail($id);

		$this->query = null;

		return $model;
	}


	/**
	 * Update the specified model
	 *
	 * @param int   $id
	 * @param array $data
	 *
	 * @return \Illuminate\Database\Eloquent\Model
	 */
	public function updateById($id, array $data)
	{
		$this->query = null;

		$model = $this->getById($id);

		$model->update($data);

		return $model;
	}


	/**
	 * Add a basic where clause to the query.
	 *
	 * @param  string  $column
	 * @param  string  $operator
	 * @param  mixed   $value
	 * @param  string  $boolean
	 * @return $this
	 */
	public function where($column, $operator = null, $value = null, $boolean = 'and')
	{
		$this->query()->where($column, $operator, $value, $boolean);

		return $this;
	}


	/**
	 * Add a where in clause to the query
	 *
	 * @param        $column
	 * @param        $values
	 * @param string $boolean
	 * @param bool   $not
	 *
	 * @return $this
	 */
	public function whereIn($column, $values, $boolean = 'and', $not = false)
	{
		$this->query()->getQuery()->whereIn($column, $values, $boolean, $not);

		return $this;
	}


	/**
	 * Add a where not in clause to the query
	 *
	 * @param        $column
	 * @param        $values
	 * @param string $boolean
	 *
	 * @return $this
	 */
	public function whereNotIn($column, $values, $boolean = 'and')
	{
		$this->query()->getQuery()->whereNotIn($column, $values, $boolean);

		return $this;
	}


	/**
	 * Set relationships to eager load
	 *
	 * @param $relations
	 *
	 * @return $this
	 */
	public function with($relations)
	{
		if (is_string($relations)) $relations = func_get_args();

		$this->query()->with($relations);

		return $this;
	}


	/**
	 * Get a query builder instance to work with
	 *
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	private function query()
	{
		if($this->query instanceof Builder)
		{
			return $this->query;
		}

		return $this->model->newQuery();
	}

}