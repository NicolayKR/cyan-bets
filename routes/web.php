<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TableController;
use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Auth;
use App\Models\CompanyName;
use App\Models\Bets;
use App\Models\CyanCallPhones;
use Spatie\ArrayToXml\ArrayToXml;
use Illuminate\Support\Facades\Storage;
use App\Models\CurrentXml;
use App\Models\Statistic;
use App\Models\StatisticShows;
use App\Models\errors_publish;
use Gaarf\XmlToPhp\Convertor;
use Illuminate\Support\Facades\DB;


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

Route::view('/','landing')->name('land');
Route::view('/index','index')->middleware('auth')->name('index');
Route::view('/question','question')->middleware('auth')->name('question');
Route::view('/errors','errors')->middleware('auth')->name('errors');
Route::view('add-form', 'add-form')->middleware('auth')->name('add-form');
Route::get('/getData','App\Http\Controllers\TableController@getData');
Route::get('/updateNow/{account}','App\Http\Controllers\XmlController@updateXml')->name('updateNow');
Route::post('/saveNewBet','App\Http\Controllers\TableController@saveNewBet');
Route::get('/getDataFromNewBet','App\Http\Controllers\TableController@getDataFromNewBet');
Route::get('getName', function(){
    return Auth::user()->name;
});
Route::get('/getBalance', 'App\Http\Controllers\TableController@getBalance');
Route::get('/getErrors', 'App\Http\Controllers\TableController@getErrors');
Route::resource('/accounts','App\Http\Controllers\AccountController');
Auth::routes();
Route::get('test', function(){
    $final_arr = [];
    $collection_errors =  DB::table('errors_publishes')
    ->join('current_xmls',function ($join) {
        $join->on('current_xmls.id_flat', '=', 'errors_publishes.id_object');
        $join->on('current_xmls.id_user', '=', 'errors_publishes.id_user');})
    ->join('company_names',function ($join) {
        $join->on('current_xmls.id_company', '=', 'company_names.id');
        $join->on('current_xmls.id_user', '=', 'company_names.user_id');})
        ->select('company_names.name','errors_publishes.id_object','errors_publishes.id_offer','errors_publishes.errors','errors_publishes.warning')
        ->where('current_xmls.id_user', Auth::user()->id)
        ->whereRaw('date(errors_publishes.updated_at) = DATE(NOW())')->get();
    foreach($collection_errors as $index=>$errors){
        $final_arr[$index]['name_company'] = $errors->name;
        $final_arr[$index]['id_object'] = $errors->id_object;
        $final_arr[$index]['errors'] = $errors->errors;
        $final_arr[$index]['warning'] = $errors->warning;
        if($errors->id_offer == null)
            $final_arr[$index]['id_offer'] = 'Не опубликован';
        else{
            $final_arr[$index]['id_offer'] = $errors->id_offer;
        }
    }
    return $final_arr;
});