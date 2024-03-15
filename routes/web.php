<?php

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
    global $users;
    return $users;
});

Route::get('/users', function(){
    global $users;
    $userName = [];
    foreach ($users as $user){
        $userName[] = $user['name'];
    } 
    echo 'The user are : ' . implode(', ', $userName);
});