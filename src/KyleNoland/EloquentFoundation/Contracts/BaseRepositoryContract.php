<?php namespace KyleNoland\EloquentFoundation\Contracts;

interface BaseRepositoryContract {

	/**
	 * Get all the models
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public function all();


	/**
	 * Count the specified models
	 *
	 * @return int
	 */
	public function count();


	/**
	 * Create a new model
	 *
	 * @param array $data
	 *
	 * @return \Illuminate\Database\Eloquent\Model
	 */
	public function create(array $data);


	/**
	 * Delete models
	 *
	 * @return mixed
	 */
	public function delete();


	/**
	 * Delete the specified model
	 *
	 * @param int $id
	 *
	 * @return int
	 */
	public function deleteById($id);


	/**
	 * Delete the specified models
	 *
	 * @param array $ids
	 *
	 * @return int
	 */
	public function deleteMultipleById(array $ids);


	/**
	 * Get the first specified model record from the database
	 *
	 * @return \Illuminate\Database\Eloquent\Model
	 */
	public function first();


	/**
	 * Get the specified models
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|static[]
	 */
	public function get();


	/**
	 * Get the specified model
	 *
	 * @param int $id
	 *
	 * @return \Illuminate\Database\Eloquent\Model
	 */
	public function getById($id);


	/**
	 * Update the specified model
	 *
	 * @param int   $id
	 * @param array $data
	 *
	 * @return \Illuminate\Database\Eloquent\Model
	 */
	public function updateById($id, array $data);


	/**
	 * Add a basic where clause to the query.
	 *
	 * @param  string  $column
	 * @param  string  $operator
	 * @param  mixed   $value
	 * @param  string  $boolean
	 * @return $this
	 */
	public function where($column, $operator = null, $value = null, $boolean = 'and');


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
	public function whereIn($column, $values, $boolean = 'and', $not = false);


	/**
	 * Add a where not in clause to the query
	 *
	 * @param        $column
	 * @param        $values
	 * @param string $boolean
	 *
	 * @return $this
	 */
	public function whereNotIn($column, $values, $boolean = 'and');


	/**
	 * Set relationships to eager load
	 *
	 * @param $relations
	 *
	 * @return $this
	 */
	public function with($relations);
}