<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddFormController;
use Illuminate\Support\Facades\Auth;

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

Route::view('/','index')->middleware('auth')->name('index');
Route::view('settings', 'settings')->name('settings');
Route::post('save-form','App\Http\Controllers\AddFormController@save');
Route::get('getName', function(){
    return Auth::user()->name;
});
Route::get('test',function(){
    $ch = curl_init();
    // set url
    curl_setopt($ch, CURLOPT_URL, "https://public-api.cian.ru/v1/get-my-balance");
    //return the transfer as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $headers = array(
        "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VySWQiOjI0MDAyODgyfQ.3xNBgSsU7UDAleK8U2znXFw8_fkcKIvMCmv-w0Dz4-c",
    );
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    // $output contains the output string
    $output = curl_exec($ch);
    echo $output;
    // close curl resource to free up system resources
    curl_close($ch);

});
Auth::routes();
