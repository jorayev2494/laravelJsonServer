<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $randomImage = rand(1, 30);
        factory(\App\Models\User::class, "admin")->create(["avatar" => "/storage/json_service/images/phone ({$randomImage}).jpg"]);

        for ($i = 1; $i <= 30; $i++) { 
            factory(\App\Models\User::class)->create(["avatar" => "/storage/json_service/images/phone ({$i}).jpg"]);
        }
    }
}
