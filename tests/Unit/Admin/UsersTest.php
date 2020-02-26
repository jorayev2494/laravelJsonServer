<?php

namespace Tests\Unit\Admin;

use Tests\TestCase;

class UsersTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_get_users()
    {
        $apiResponse = $this->json("GET", "/api/users");
        dd($apiResponse->getContent());
    }
}
