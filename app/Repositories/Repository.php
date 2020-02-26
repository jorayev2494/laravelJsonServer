<?php

namespace App\Repositories;

abstract class Repository {

    private $model;

    public function __construct() {
        $this->model = app($this->getModel());
    }

    abstract public function getModel() : string;

    public function getModelClone()
    {
        return clone $this->model;
    }

    /**
     * Handle dynamic method calls into the model.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
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