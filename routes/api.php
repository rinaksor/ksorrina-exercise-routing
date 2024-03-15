<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('/user')->group(function(){
    Route::get('/user', function () {
        global $users;
        return response()->json($users);
        //return $users;
    });
    
    Route::get('/user/{userIndex}', function ($userIndex) {
        global $users;
        
        if (isset($users[$userIndex])) {
            return response()->json($users[$userIndex]);
        } else {
            return 'cannot find the user with index '.$userIndex;
        }
    })->where('userIndex', '[0-9]+');
    
    Route::get('/user/{userName}', function ($userName) {
        global $users;
        
        foreach ($users as $user) {
            if ($user['name'] === $userName) {
                return response()->json($user);
            }
            else{
                return 'cannot find the user with name '.$userName;
            }
        }
    })-> where('userName', '[a-zA-Z]+');
    

    Route::get('user/{userIndex}/post/{postIndex}', function($userIndex, $postIndex){
        global $users;

        if (isset($users[$userIndex])){
            $user = $users[$userIndex];
            if(isset($user['posts'][$postIndex])){
                $post = $user['posts'][$postIndex];
                return response()->json($post);
            }else{
                return 'Cannot find the post with index ' . $postIndex . ' for user with index ' . $userIndex;
            }
        }else{
            return 'Cannot find the user with index ' . $userIndex;
        }
            
    })->where(['userIndex' => '[0-9]+', 'postIndex' => '[0-9]+']);




    Route::fallback(function () {
        return "You cannot get a user like this!";
    });
});