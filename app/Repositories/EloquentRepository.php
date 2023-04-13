<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;

abstract class EloquentRepository implements EloquentInterface
{
    protected $_model;

    abstract public function getModel();

    public function __construct()
    {
        $this->setModel();
    }

    public function setModel()
    {
        $this->_model = app()->make(
            $this->getModel()
        );
    }

    public function all()
    {
        return $this->_model->all();
    }

    public function create(array $data)
    {
        return $this->_model->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->findById($id)->update($data);
    }

    public function deleteById($id)
    {
        return $this->find($id)->delete();
    }

    public function deleteByModel($object)
    {
        return $object->delete();
    }

    public function findById($id)
    {
        try {
            return $this->_model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return false;
        }
    }
}
