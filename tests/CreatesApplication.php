<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;
use Artisan;

trait CreatesApplication
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();


        Artisan::call("config:clear");
        Artisan::call("cache:clear");
        Artisan::call("migrate:fresh --seed");

        return $app;
    }
}
