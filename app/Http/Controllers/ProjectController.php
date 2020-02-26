<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

trait ProjectController
{
    public function test()
    {
        // echo __METHOD__;
        dd(__METHOD__);
    }
}
