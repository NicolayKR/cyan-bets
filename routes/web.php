<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddFormController;
use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Auth;
use App\Models\CompanyName;

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
Route::view('add-form', 'add-form')->name('add-form');
Route::post('accounts/save-form','App\Http\Controllers\AddFormController@save');
Route::get('getName', function(){
    return Auth::user()->name;
});
Route::post('/updateCompany','App\Http\Controllers\AddFormController@update')->name('updateCompany');
Route::resource('/accounts','App\Http\Controllers\AccountController');
Auth::routes();
Route::get('test',function(){
    // $collection = CompanyName::select('name','xml_feed','cyan_key')
    //                         ->where('user_id', Auth::user()->id)
    //                         ->groupBy('name','xml_feed','cyan_key')
    //                         ->get();
    // return $collection;
});