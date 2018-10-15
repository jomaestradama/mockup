<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

use App\Task;
use App\Mock;
use App\MocksPhoto;
use Illuminate\Http\Request;

Route::get('/upload', 'UploadController@uploadForm');
Route::post('/upload', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'cuenta' => 'required|max:255',
        'photo' => 'image|mimes:jpeg,bmp,png|size:2000'
    ]);

    if ($validator->fails()) {
        return redirect('/upload')
            ->withInput()
            ->withErrors($validator);
    }

    $mock = Mock::create();
    $photo = MocksPhoto::create();
    $mock->cuenta = $request->cuenta;
    $mock->save();
    foreach ($request->photos as $photo) {
        $filename = $photo->store('photos');
        MocksPhoto::create([
            'mock_id' => $mock->id,
            'filename' => $filename
        ]);
    }
  

    return redirect('/upload');
});

Route::group(['middleware' => ['web']], function () {
    /**
     * Show Task Dashboard
     */
    Route::get('/', function () {
        return view('tasks', [
            'tasks' => Task::orderBy('created_at', 'asc')->get()
        ]);
    });

    /**
     * Add New Task
     */
    Route::post('/task', function (Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

        $task = new Task;
        $task->name = $request->name;
        $task->save();

        return redirect('/');
    });

    /**
     * Delete Task
     */
    Route::delete('/task/{id}', function ($id) {
        Task::findOrFail($id)->delete();

        return redirect('/');
    });
});
