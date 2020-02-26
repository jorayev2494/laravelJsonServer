<?php

namespace App\Repositories\Interfaces;

interface IRepository {
    public function getAll($keys = "*");
    public function findById(int $id);
}

?>