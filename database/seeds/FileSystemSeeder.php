<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class FileSystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        File::deleteDirectories(storage_path("app/public/json_service/"));
        File::copyDirectory(resource_path("json_service/"), storage_path("app/public/json_service/"));
    }
}
