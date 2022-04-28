<?php

use App\Http\Controllers\ProjectsController;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Mail\ContactFormMailable;
use Illuminate\Support\Facades\Mail;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', function () {
    return view('index');
});

// This will link all of the projects on a single page
Route::get('/projects', [ProjectsController::class,'index']);

// This allows the page to render that is in question
Route::get('/projects/{project}', [ProjectsController::class,'show']);

Route::post('/projects', [ProjectsController::class,'store']);
