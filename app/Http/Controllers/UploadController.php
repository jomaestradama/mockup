<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\UploadRequest;

class UploadController extends Controller
{
    //
    public function uploadForm()
    {
        return view('mocks');
    }
 
    public function uploadSubmit(UploadRequest $request)
    {
      
        $validator = Validator::make($request->all(), [
            'cuenta' => 'required|max:255',
        ]);
    
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

        $mock = new Mock;
        
        $mock->cuenta = $request->cuenta;
        $mock>save();
        foreach ($request->photos as $photo) {
            $filename = $photo->store('photos');
            MocksPhoto::create([
                'mock_id' => $mock->id,
                'filename' => $filename
            ]);
        }
        return 'Upload successful!';
    }
}
