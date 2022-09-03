<?php

namespace App\Http\Services\User;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\User_attribute;
use Illuminate\Support\facades\Auth;

class UserService
{
    public function get(){
        $id = Auth::id();
        return User::where('id',$id)
        ->with('profile')
        ->firstOrFail();
    }
}