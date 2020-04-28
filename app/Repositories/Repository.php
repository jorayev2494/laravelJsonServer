<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class Repository {

    private $model;
    protected $select = ["*"];

    public function __construct()
    {
        $this->model = app($this->getModel());
    }

    abstract public function getModel() : string;

    public function getModelClone() : Model
    {
        return clone $this->model;
    }

    public function setSelect(array $select) : void
    {
        $this->select = $select;
    }

    protected function getSelect() : array
    {
        return $this->select;
    }

    /**
     * Handle dynamic method calls into the model.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters) : mix
    {
        if (!is_null($method) && is_array($parameters)) {
            return $this->getModelClone()->$method(...$parameters);
        } 

        if (!is_null($method) && !is_null($parameters)) {
            return $this->getModelClone()->$method($parameters);
        }

        return $this->getModelClone()->$method();
    }
}