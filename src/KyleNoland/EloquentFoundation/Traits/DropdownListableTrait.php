<?php namespace KyleNoland\EloquentFoundation\Traits;

trait DropdownListableTrait {

	/**
	 * Get an array of drop down menu options
	 *
	 * @param string $valueColumn
	 * @param string $textColumn
	 *
	 * @return array
	 */
	public static function getDdlOptions($valueColumn = 'id', $textColumn = 'name', array $placeholders = null)
	{
		$models = self::all();

		$options = array();

		//
		// Prepend an array of placeholder options
		//

		if( ! is_null($placeholders))
		{
			$options = $placeholders;
		}

		//
		// Create an array of key/value pairs suitable for creating a dropdown menu
		//

		foreach($models as $model)
		{
			$options[$model->getAttribute($valueColumn)] = $model->getAttribute($textColumn);
		}

		return $options;
	}

}
