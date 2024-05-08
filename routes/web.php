<?php

use App\Http\Controllers\Api\BranchesController;
use App\Http\Controllers\Api\TestsController;
use Illuminate\Support\Facades\Route;

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


// Route::get('/f', function () {
//     return view('components/layouts/app');
// });
Route::get('/api/tests', [TestsController::class, 'index']);
Route::get('/api/branches', [BranchesController::class, 'index']);

