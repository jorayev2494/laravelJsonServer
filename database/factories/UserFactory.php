<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/
// Admin
$factory->defineAs(User::class, "admin", function (Faker $faker) {
    return [
        'name'              => "Admin",
        'last_name'         => "Adminov",
        'avatar'            => User::DEFAULT_AVATAR,     // $faker->imageUrl(255, 255, "cats", true, "JsonServer"),
        'phone'             => $faker->phoneNumber,
        'email'             => "admin@admin.com",
        'email_verified_at' => now(),
        'password'          => bcrypt(476674), // password: 476674
        'remember_token'    => Str::random(10),
    ];
});

// User
$factory->define(User::class, function (Faker $faker) {
    return [
        'name'              => $faker->name,
        'last_name'         => $faker->lastName,
        'avatar'            => User::DEFAULT_AVATAR,     // $faker->imageUrl(255, 255, "cats", true, "JsonServer"),
        'phone'             => $faker->phoneNumber,
        'email'             => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token'    => Str::random(10),
    ];
});
