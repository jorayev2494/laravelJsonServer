<?php

namespace App\Http\Controllers\Api;

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
        $this->user_r       = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $users = $this->user_r->getAll()->sortByDesc("id")->take(250);
        $users = $this->user_r->getAllSortByDesc("*", 100);

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
        
        // Save Avatar
        $avatarPath = "start";
        if ($request->hasFile("avatar")) {
            $extension = $request->file("avatar")->getClientOriginalExtension();
            $fileName = rand(1, 100) + time();
            $avatarPath = "/storage/" . $request->file("avatar")->storeAs("/users", $fileName . "." . $extension, "public");
        }

        // Create User
        $stored = $this->user_r->create(array_merge($data, [
            "password"  => bcrypt($data["password"]),
            "avatar"    => $avatarPath,
            "name"      => "AWdawddawd",
        ]));

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
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $update = $this->user_r->findById($id);


        // "HHHHHHHHHeader: {$request->header}
        \Log::info("HHHHHHHHHeader: ", [$request->hasFile('avatar') ? 'da' : 'nnn']);
        \Log::info("Info: ", $request->all());

        $avatarPath = $update->avatar;
        if ($request->file("avatar")) {
            unlink(public_path() . $update->avatar);
            $extension = $request->file("avatar")->getClientOriginalExtension();
            $fileName = rand(1, 100) + time();
            $avatarPath = "/storage/" . $request->file("avatar")->storeAs("/users", $fileName . "." . $extension, "public");
        }

        // Updating
        $update->update(array_merge($data, [
                "password"  => bcrypt("mobile"),            // Password Hashing
                "avatar"    => $avatarPath
            ])
        );

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

    // Mobile Images
    public function file(Request $request)
    {
        $data = $request->all();

        $avas = [];
        if ($request->hasFile("avatar")) {

            // $filePath = "/storage" . $request->file("avatar")->store("/one", "public");

            foreach ($request->avatar as $key => $ava) {
                $n = "/storage" . $ava->store("/ttte", "public");
                $avas[$n] = $ava;
            }
        }

        return $this->mobileResponseApi([$request->all(), $request->hasFile("avatar")], 200);

        // dd($request->hasFile("file"), $data);
        $filePath = "start";

        // dd($data, $request->hasFile("avatar"), $request->file("avatar"));

        \Log::info("HHHHHHHHHeader: {$request->header} Has Ava: " . ($request->hasFile('avatar')) ? 'DDa' : 'NneT');

        try {
            // if ($request->hasFile("avatar")) {
                foreach($data as $k => $v)
                    \Log::info("Key: >>, Val: {$v}");
                $filePath = "/storage/" . $v[0]->store("/mobile", "public");
                \Log::info(">> Fille: {$request->file}");
            // } else {
                // foreach($data as $k => $v)
                    // \Log::info("Key: {$k}, Val: {$v}");
                // $filePath = "else";
            // }
        } catch (\Throwable $th) {
            $filePath = $th->getMessage();
        }

        return $this->mobileResponseApi([$filePath, $request->hasFile("avatar")], 200);
    }
}
