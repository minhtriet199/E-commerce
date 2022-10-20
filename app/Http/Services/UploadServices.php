<?php

namespace App\Http\Services;

class UploadServices{
    
    public function store($request,$name){
        $pathFull = 'uploads/' . date("Y/m/d");

        $request->file('file')->storeAs(
            'public/' . $pathFull, $name
        );

        return '/storage/' . $pathFull . '/' . $name;
    }
    public function store_multi($photo,$name){
        $pathFull = 'uploads/' . date("Y/m/d");

        $photo->storeAs(
            'public/' . $pathFull, $name
        );

        return '/storage/' . $pathFull . '/' . $name;
    }

}
