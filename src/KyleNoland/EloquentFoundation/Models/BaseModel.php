<?php namespace KyleNoland\EloquentFoundation\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
	/**
	 * Models that always get eagerly loaded with this model
	 *
	 * @var array
	 */
	protected $with = array();


	/**
	 * The attributes excluded from the model's JSON form
	 *
	 * @var array
	 */
	protected $hidden = array();


	/**
	 * The attributes that cannot be mass assigned
	 *
	 * @var array
	 */
	protected $guarded = array('id', 'created_at', 'updated_at', 'deleted_at');


	/**
	 * The attributes that can be mass assigned
	 *
	 * @var array
	 */
	protected $fillable = array();


	/**
	 * The attributes that should be return as Carbon instances
	 *
	 * @var array
	 */
	protected $dates = array();


	/**
	 * Numeric attributes
	 *
	 * @var array
	 */
	protected $numericAttributes = array();


	/**
	 * Currency attributes
	 *
	 * @var array
	 */
	protected $currencyAttributes = array();


	/**
	 * Optional placeholder value and text when generating DDL option arrays
	 *
	 * @var array
	 */
	protected static $ddlPlaceholder = array();


	/**
	 * Static class instance
	 *
	 * @var mixed
	 */
	protected static $_instance = null;


	/**
	 * Get an instance of this class
	 *
	 * @return mixed|static
	 */
	private static function getInstance()
	{
		if(is_null(self::$_instance))
		{
			self::$_instance = new static;
		}

		return self::$_instance;
	}


	/**
	 * Date attributes to be returned as Carbon instances
	 *
	 * @return array
	 */
	public function getDates()
	{
		return array_merge(
			array('created_at', 'updated_at', 'deleted_at'),
			$this->dates
		);
	}


	/**
	 * Get the currency attributes array
	 *
	 * @return array
	 */
	public function getCurrencyAttributes()
	{
		return $this->currencyAttributes;
	}


	/**
	 * Get the numeric attributes array
	 *
	 * @return array
	 */
	public function getNumericAttributes()
	{
		return $this->numericAttributes;
	}


	/**
	 * Does the model have any currency attributes
	 *
	 * @return bool
	 */
	public function hasCurrencyAttributes()
	{
		return ! empty($this->currencyAttributes);
	}


	/**
	 * Does the model have any numeric attributes
	 *
	 * @return bool
	 */
	public function hasNumericAttributes()
	{
		return ! empty($this->numericAttributes);
	}


	/**
	 * Get an array of drop down menu options
	 *
	 * @param string $valueColumn
	 * @param string $textColumn
	 *
	 * @return array
	 */
	public static function getDdlOptions($valueColumn = 'id', $textColumn = 'name')
	{
		$instance = self::getInstance();

		$models = $instance->newQuery()->get();

		$options = array();

		if( ! empty(self::$ddlPlaceholder))
		{
			$options = self::$ddlPlaceholder;

			self::$ddlPlaceholder = array();
		}

		foreach($models as $model)
		{
			$options[$model->getAttribute($valueColumn)] = $model->getAttribute($textColumn);
		}

		return $options;
	}


	/**
	 * Add a placeholder drop down menu option
	 *
	 * @param      $label
	 * @param null $value
	 *
	 * @return BaseModel|mixed
	 */
	public static function withPlaceholder($label, $value = null)
	{
		self::$ddlPlaceholder[$value] = $label;

		return self::getInstance();
	}


	/**
	 * Add one or more placeholder drop down menu options
	 *
	 * @param array $placeholders
	 *
	 * @return BaseModel|mixed
	 */
	public static function withPlaceholders(array $placeholders)
	{
		foreach($placeholders as $label => $value)
		{
			self::withPlaceholder($label, $value);
		}

		return self::getInstance();
	}
}