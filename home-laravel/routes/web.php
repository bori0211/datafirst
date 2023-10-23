<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoardsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TopicController;
use App\Models\Topic;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('boards', BoardsController::class);

Route::get('/home', function () {
    //$topics = Topic::where('user_id', auth()->id())->get();
    $topics = [];
    if (auth()->check()) {
        $topics = auth()->user()->usersCoolTopics()->latest()->get();
    }

    return view('home', ['topics' => $topics]);
});

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);

Route::post('/create-topic', [TopicController::class, 'createTopic']);
Route::get('/edit-topic/{topic}', [TopicController::class, 'showEditScreen']);
Route::put('/edit-topic/{topic}', [TopicController::class, 'actuallyUpdateTopic']);
Route::delete('/delete-topic/{topic}', [TopicController::class, 'deleteTopic']);
