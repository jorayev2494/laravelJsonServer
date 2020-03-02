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

    /**
     * Get All Users from Db with sorted Desc
     *
     * @param string $keys
     * @return void
     */
    public function getAllSortByDesc($keys = "*", int $take = null)
    {
        $build = $this->getModelClone()->orderBy("id", "DESC")->get();

        if ($take) 
            return $build->take($take);

        return $build;
    }

    public function findById(int $id) {
        return $this->getModelClone()->find($id);
    }
}
