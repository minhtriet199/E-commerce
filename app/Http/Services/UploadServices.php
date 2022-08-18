<?php

namespace App\Http\Services;

class UploadServices{
    
    public function store($request)
    {
        if  ($request->hasFile('file')){
            try{
                $file = $request->file('file');
                $name = $file->getClientOriginalName();

                $pathFull = 'uploads/' .date("Y/m/d");
                $path = $request->file('file')->storeAs(
                    'public/' .$pathFull , $name
                );
                return '/storage/'.$pathFull .'/'.$name;
            }catch(\Exception $error) {
                return false;
            }
        }
    }
}
