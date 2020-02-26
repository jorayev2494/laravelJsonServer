<?php

namespace App\Repositories;

use App\Repositories\Interfaces\IRepository;
use App\Models\User as Model;

class UserRepository extends Repository implements IRepository
{
    public function getModel() : string 
    {
        return Model::class;
    }

    public function getAll($keys = "*") {
        return $this->getModelClone()->all($keys);
    }

    public function findById(int $id) {
        return $this->getModelClone()->find($id);
    }
}
