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
    $current_api ='eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VySWQiOjI0MDAyODgyfQ.3xNBgSsU7UDAleK8U2znXFw8_fkcKIvMCmv-w0Dz4-c';
    //$current_api = $request->input('key-cyan');
    $referer = 'http://www.google.com';
    $url = 'http://public-api.cian.ru/v1/get-my-balance';
    $header = array();
    //curl -X GET -H 'Authorization: Bearer <ACCESS TOKEN>' https://public-api.cian.ru/v1/get-my-offers?source=manual&statuses=inactive&statuses=published&usersIds=106815&usersIds=106816
    $ch_a = curl_init();
    curl_setopt($ch_a, CURLOPT_URL, $url);
    curl_setopt($ch_a, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch_a, CURLOPT_HTTPHEADER, array('Authorization: Bearer <'.$current_api.'>'));
    curl_setopt($ch_a, CURLOPT_HEADER, false);
    curl_setopt($ch_a, CURLOPT_REFERER, $referer);
    $response = curl_exec($ch_a); 
    curl_close($ch_a);
    return $response;
    // $doc_page = new Document();
    // $doc_page->loadHtml($response);  
    // return $doc_page;
});
Auth::routes();
