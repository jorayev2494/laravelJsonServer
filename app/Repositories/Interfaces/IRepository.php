<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface IRepository {
    public function getAll() : Collection;
    public function findById(int $id) : Model;
}

?>