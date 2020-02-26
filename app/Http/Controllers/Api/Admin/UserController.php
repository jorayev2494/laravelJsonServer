<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\Admin\Users\UserStoreRequest;
use App\Http\Requests\Admin\Users\UserUpdateRequest;

class UserController extends Controller
{
    private $user_r;

    public function __construct(UserRepository $userRepository) {
        $this->user_r = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->user_r->getAll();
        return $this->mobileResponseApi($users, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        // For Mobile
        $data["password"] = "mobile";

        // Hashing Password
        $data = array_merge($data, 
            [
                "password" => bcrypt($data["password"]),
                "avatar"   => "/storage/images/default.jpg",
            ]
        );

        // Create User
        $stored = $this->user_r->create($data);

        return $this->mobileResponseApi($stored, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
        
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $data = $request->all();

        $update = $this->user_r->findById($id);

        // For Mobile
        $data["password"] = "mobile";

        // Hashing Password
        // if (array_key_exists("password", $data)) {
            $data = array_merge(
                $data,
                [
                    "password" => bcrypt($data["password"]),
                    "avatar"   => "/storage/images/photo.jpg",
                ]
            );
        // }

        // Updating
        $update->update($data);

        return $this->mobileResponseApi($update, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = $this->user_r->findById($id);

        if (!$delete) return $this->mobileResponseApi(null, 404, "Not Found!");
        
        // Deleting
        $delete->delete();

        return $this->mobileResponseApi(null, 200);
    }
}
