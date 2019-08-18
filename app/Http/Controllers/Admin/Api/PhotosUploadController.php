<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;

class PhotosUploadController extends Controller
{
    /**
     * As motorcycle is not created yet, we are using temp key to check how many photos 
     * were added to the database already. If there is less than 6 of them,
     * upload a new photo and return its id and url so it can be displayed on frontend.
     * 
     * @param string $temp
     * @return json
     */
    public function store($temp) 
    {
        if(Photo::where('temp', $temp)->count() < 7)
        {
            $this->validateRequest();
    
            $photo = Photo::create([
                'url' => request()->file('photo')->store('photos', 's3'),
                'temp' => $temp
            ]);

            $response = [[
                'id' => $photo->id,
                'url' => $photo->url
            ], 200];
        }
        else
        {
            $response = [[
                'status' => 'error',
                'message' => 'Możesz dodać maksymalnie 7 zdjęć.'
            ], 500];
        }
        
        return response()->json(...$response);
    }
}
