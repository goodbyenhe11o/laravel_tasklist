<?php

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//to display all routes 
Route::group(['middleware'=>'web'], function(){

Route::get('/', function() {
    // return view('welcome');

    // return view('layouts/master');
    // return view('/', 'blog@home');

    //Task App
    return view ('tasks');

});


//below for the sample Task app

Route::post('/task', function (Request $request) {
    
//to validate if name.length will go over 255 characters

$validator = Validator::make($request->all(),[
    'name'=>'required|max:255']);

// $validator = Validator::make($request->all(), [
//         'name' => 'required|max:255',
//     ]);    


    if($validator->fails()){
        return redirect('/')
        ->withInput()
        ->withErrors($validator);
    }

    //create new tasks
    $task = new App\Models\Task;
    $task->name = $request->name;//user's name input
    $task->save();

    return redirect('/');

});

Route::get('/', function(){

    // $tasks=Task::orderBy('create_at', 'asc')->get(); //display all the tasks by create time, the earliest to be shown first
    $tasks= App\Models\Task::all();


    return view ('task',[
        'task' => $tasks
    ]);

});

Route::delete('/task/{task}', function ($id){

    $task->delete();
    return redirect('/');
    });

});