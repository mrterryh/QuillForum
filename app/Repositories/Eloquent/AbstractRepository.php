<?php

namespace Quill\Repositories\Eloquent;

abstract class AbstractRepository
{
    /**
     * Stores the Eloquent model for the repository.
     * 
     * @var Model
     */
    protected $modelInstance;

    /**
     * Resolves and returns the required model for the repository, by
     * reading the $model property of the subclass.
     * 
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getModel()
    {
        if ($this->modelInstance)
            return $this->modelInstance;

        if (! isset($this->model))
            throw new \Exception("No model specified for " . get_class($this));

        return $this->modelInstance = app($this->model);
    }

    /**
     * Returns all records in the database.
     * 
     * @return object
     */
    public function all()
    {
        return $this->getModel()->all();
    }

    /**
     * Returns all the records in the database, paginated.
     * 
     * @param  integer $perPage The number of records to show per page.
     * @param  array   $with    Relationships to eager-load (e.g. user, for threads).
     * @return object
     */
    public function paginate($perPage = 10, $with = [])
    {
        return $this->getModel()->with($with)->paginate($perPage); 
    }

    /**
     * Returns the record associated with the given ID.
     * 
     * @param  integer $id
     * @param  array   $with
     * @return object
     */
    public function find($id, $with = [])
    {
        return $this->getModel()->with($with)->findOrFail($id);
    }

    /**
     * Creates a record in the database.
     * 
     * @param  array  $attributes
     * @return object
     */
    public function create($attributes = [])
    {
        return $this->getModel()->create($attributes);
    }

    /**
     * Deletes a record from the database.
     * 
     * @param  integer $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->find($id)->delete();
    }

    /**
     * Updates the record in the database with the given ID.
     * 
     * @param  integer $id
     * @param  array   $data
     * @return mixed
     */
    public function update($id, $data = [])
    {
        $post = $this->find($id);

        return $post->update($data);
    }
}