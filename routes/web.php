<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddFormController;
use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Auth;
use App\Models\CompanyName;
use Spatie\ArrayToXml\ArrayToXml;
use Illuminate\Support\Facades\Storage;

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
    $current_xml = 'https://nasledie-don.ru/admin/upload/cian_flats_rnd.xml';
    // $contents = @file_get_contents($current_xml);
    // $result = json_encode($contents);
    // return $result;
    $xml = simplexml_load_file($current_xml);
    $json = json_encode($xml);
    $array = json_decode($json,TRUE);
    $result = ArrayToXml::convert($array);
    $res = CompanyName::select('id')->where('cyan_key', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VySWQiOjI0MDAyODgyfQ.3xNBgSsU7UDAleK8U2znXFw8_fkcKIvMCmv-w0Dz4-c')
        ->get();
    $id_user = $res[0]['id'];
    if(!Storage::exists('public/'.Auth::user()->id.'/'.$id_user.'/xml-feed.xml')){
        Storage::put('public/'.Auth::user()->id.'/'.$id_user.'/xml-feed.xml', $result);
    }
    $url = Storage::url('public/'.Auth::user()->id.'/'.$id_user.'/xml-feed.xml');
    return $url;
    // return $res;
});