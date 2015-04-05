<?php namespace KyleNoland\EloquentFoundation\Traits;

trait DropdownListableTrait {

	/**
	 * Get an array of drop down menu options
	 *
	 * @return array
	 */
	public static function getDdlOptions()
	{
		$args = func_get_args();

		$valueAttribute = isset($args['value']) ? $args['value'] : 'id';
		$textAttribute  = isset($args['text']) ? $args['text'] : 'name';
		$placeholders   = isset($args['placeholders']) ? $args['placeholders'] : array();

		$models = self::all();

		$options = $placeholders;

		//
		// Create an array of key/value pairs suitable for creating a dropdown menu
		//

		foreach($models as $model)
		{
			$options[$model->getAttribute($valueAttribute)] = $model->getAttribute($textAttribute);
		}

		return $options;
	}


	/**
	 * Get a JSON string of drop down menu options
	 *
	 * @return string
	 */
	public static function getDdlOptionsAsJson()
	{
		$args = func_get_args();

		$options = self::getDdlOptions($args);

		return json_encode($options);
	}

}