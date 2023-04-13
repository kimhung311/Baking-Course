<?php

namespace App\Repositories;

interface EloquentInterface
{
    /**
     * Get all entry in Model
     *
     * @return mixed
     */
    public function all();

    /**
     * Create entry of the Model
     *
     * @param  array $data
     * @return void
     */
    public function create(array $data);

    /**
     * Update entry of the Model
     *
     * @param  array $data
     * @param  mixed $id
     * @return void
     */
    public function update(array $data, $id);

    /**
     * Delete from id of the Model
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteById($id);

    /**
     * Delete from object of the Model
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteByModel($object);

    /**
     * Find by id
     *
     * @param  mixed $id
     * @return void
     */
    public function findById($id);
}
