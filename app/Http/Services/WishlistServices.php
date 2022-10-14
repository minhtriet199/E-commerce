<?php

namespace App\Http\Services;
use Illuminate\Support\facades\Auth;
use App\Models\whistlist;

class WishlistServices{
    
    public function get(){
        return whistlist::where('user_id',Auth::id())
        ->with('products')
        ->get();
    }
}
