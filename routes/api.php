<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\TeacherController;
use App\Http\Controllers\ShecduleDefese;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('auth/register',[UserController::class,'register']);
Route::post('auth/login',[UserController::class,'login']);
Route::get('get_student',[UserController::class,'get_student']);
Route::group(['middleware'=>['auth:sanctum']],function(){
    Route::get('auth/get_user',[UserController::class,'get_user']);
    Route::post('auth/logout',[UserController::class,'logout']);
    
});
//Shool
Route::post('school/create_schedule',[ShecduleDefese::class,'create']);
Route::get('school/show_schedule',[ShecduleDefese::class,'show']);
Route::get('school/showcandidate',[ShecduleDefese::class,'listCaditate']);
Route::post('adviosr/add_info',[TeacherController::class,'add_adivisor_info']);
Route::get('adviosr/show_rating',[TeacherController::class,'show_rating']);
