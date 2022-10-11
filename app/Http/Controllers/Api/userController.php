<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class userController extends Controller
{

    public function index()
    {
        $user = User::all();
        return response()->json([
            "success" => true,
            "message" => "user List",
            "data" => $user
            ]);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(User $user)
    {
        //
    }
    public function update(Request $request, User $user)
    {
        //
    }
    public function destroy(User $user)
    {
        //
    }
}
