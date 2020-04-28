<?php

namespace App\Repositories;

use App\Repositories\Interfaces\IRepository;
use App\Models\User as Model;
use Illuminate\Database\Eloquent\Collection;

class UserRepository extends Repository implements IRepository
{
    public function getModel() : string 
    {
        return Model::class;
    }

    /**
     * Get All User form DataBase
     *
     * @return Collection
     */
    public function getAll() : Collection
    {
        return $this->getModelClone()->all($this->getSelect());
    }

    /**
     * Get All Users from Db with sorted Desc
     *
     * @param integer $take
     * @return Collection
     */
    public function getAllSortByDesc(int $take = null) : Collection
    {
        $build = $this->getModelClone()->select($this->getSelect())->orderBy("id", "DESC")->get();

        if ($take)
            $build = $build->take($take);

        // $build->map(function($user) {
        //     return $user->full_name;    // = trim($user->full_name);
        // });

        return $build;
    }

    
    public function findById(int $id) : Model
    {
        return $this->getModelClone()->select($this->getSelect())->find($id);
    }
}
