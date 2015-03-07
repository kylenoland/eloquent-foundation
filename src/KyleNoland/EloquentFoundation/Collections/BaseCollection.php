<?php namespace KyleNoland\EloquentFoundation\Collections;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseCollection extends Collection {

	/**
	 * Count the unique values of the specified attribute that appear in the Collection
	 *
	 * @param string $attribute
	 *
	 * @return int
	 */
	public function countUnique($attribute)
	{
		return count($this->getUnique($attribute));
	}


	/**
	 * Delete all the records in the collection
	 */
	public function deleteAll()
	{
		$this->each(function(Model $model)
		{
			$model->delete();
		});
	}


	/**
	 * Get an array containing the unique values of the specified attribute that appear in the Collection
	 *
	 * @param string $attribute
	 *
	 * @return array
	 */
	public function getUnique($attribute)
	{
		return array_unique($this->lists($attribute));
	}


	/**
	 * Create a CSV string from the specified model attribute
	 *
	 * @param string $field
	 *
	 * @return string
	 */
	public function toCsv($field = 'name')
	{
		return implode(',', $this->lists($field));
	}
	
}