Eloquent Foundation
===================

The purpose of Eloquent Foundation is to provide a set of base classes for Laravel's Eloquent ORM that will speed
development for most projects. You are free to use as many or as few of the Eloquent Foundation classes as you like.

Installation
------------

Install via Composer:

    composer require kyle-noland/eloquent-foundation

Add the Service Provider to config/app.php

    'providers' => [
        ...
        'KyleNoland\EloquentFoundation\Providers\EloquentFoundationServiceProvider',
    ]

Usage
-----

Eloquent Foundation is opinionated and makes some assumptions regarding your database field names. For instance,
the PersonTrait assumes that your Eloquent Model contains at least the following attributes:

- first_name
- last_name
- email

Most of the Eloquent Foundation classes are small. You should read through them to see how they work.

Probably the most generally useful components of Eloquent Foundation are the BaseRepositoryContract and BaseRepository
classes. The intent is to provide an Eloquent repository implementation to build upon while maintaining some of the more
common fluent Eloquent methods. *You get a lot of repository boilerplate for free and only have to write your
application-specific methods in your child classes*.

For example, if you extend the BaseRepository class in your own InvoiceRepository class, you get a lot of good Eloquent
methods "for free" while keeping direct access to your Eloquent models out of your controllers or service classes.
You can do things like:

    class SomeController extends Controller {

        protected $invoiceRepo;

        public function __construct(InvoiceRepositoryContract $invoiceRepo)
        {
            $this->invoiceRepo = $invoiceRepo;
        }

        public function something()
        {
            // Update a specific Invoice record
            $invoice = $this->invoiceRepo->updateById($id, $data);

            // Retrieve a specific Invoice record
            $invoice = $this->invoiceRepo->getById($id);

            // Retrieve all the Invoice records
            $invoices = $this->invoiceRepo->all();

            // Retrieve a Collection of Invoice records
            $invoices = $this->invoiceRepo->whereIn('id', [1, 2, 3, 10])->get();

            // Add the with() method to any "get-style" call to eager load related models
            $invoices = $this->invoiceRepo->with('Company', 'Company.Users')->whereIn('id', [1, 2, 99])->get();

            // Delete a particular Invoice record
            $this->invoiceRepo->deleteById($id);
        }

    }

The BaseRepository class exposes the following boilerplate methods that you can leverage in any of your child classes:

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
     * Count the specified models
     *
     * @param $column
     * @param $value
     *
     * @return int
     */
    public function countBy($column, $value);


    /**
     * Create a new model
     *
     * @param array $data
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data);


    /**
     * Create one or more new model records in the database
     *
     * @param array $data
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function createMultiple(array $data);


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
     * Get the first specified model record from the database
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function firstOrFail();


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
     * Add a group by clause to the query
     *
     * @param $columns
     *
     * @return $this
     */
    public function groupBy($columns);


    /**
     * Add a limit clause to the query
     *
     * @param int $limit
     *
     * @return $this
     */
    public function limit($limit);


    /**
     * Add an order by clause to the query.
     *
     * @param  string  $column
     * @param  string  $direction
     * @return $this
     */
    public function orderBy($column, $direction = 'asc');


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
