<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

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

Route::get('/kanban', [TaskController::class, 'showTasks'])->name('show.task');

Route::post('/kanban-board/task/add', [TaskController::class, 'ajaxInsert'])->name('task.ajaxInsert');
Route::post('/kanban-board/task/update', [TaskController::class, 'ajaxUpdate'])->name('task.ajaxUpdate');
Route::get('/kanban-board/task/delete/{id}', [TaskController::class, 'ajaxDelete'])->name('task.ajaxDelete');
