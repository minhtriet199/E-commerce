<?php

namespace App\Http\Services;

class UploadServices{
    
    public function store($request)
    {
        $name = time().'.png';
        $pathFull = 'uploads/' . date("Y/m/d");

        $request->file('file')->storeAs(
            'public/' . $pathFull, $name
        );

        return '/storage/' . $pathFull . '/' . $name;
    }
}
