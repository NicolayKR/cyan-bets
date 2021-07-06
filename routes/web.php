<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TableController;
use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Auth;
use App\Models\CompanyName;
use App\Models\Bets;
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
Route::get('/getData','App\Http\Controllers\TableController@getData');
Route::post('/saveNewBet','App\Http\Controllers\TableController@saveNewBet');
Route::get('/getDataFromNewBet','App\Http\Controllers\TableController@getDataFromNewBet');
Route::get('getName', function(){
    return Auth::user()->name;
});
Route::resource('/accounts','App\Http\Controllers\AccountController');
Auth::routes();

Route::get('test',function(){

    
        // $bet = 200;
        // $id = 200;
        // $id_company = 2;
        // $result = Bets::select(Bets::raw('COUNT(*)'))
        //                 ->where('id_flat', $id)
        //                 ->where('id_company', $id_company)
        //                 ->where('id_user', Auth::user()->id)
        //                 ->count(); 
        // if($result == 1 ){
        //     Bets::where('id_flat', '=', $id)->
        //             where('id_company', '=', $id_company)-> 
        //             where('id_user', Auth::user()->id)->
        //             update(array('bet' => $bet));
        // }
        // else{
        //     $newBet = Bets::create(array(
        //         'id_flat' =>$id,
        //         'bet'=> $bet,
        //         'id_user'=> Auth::user()->id,
        //         'id_company'=> $id_company 
        //     ));
        //     $newBet->save();
        // }

 });
 

 //Метод наполнения таблицы ставок в БД
Route::get('test2',function(){

    $id_object = 157571;
    $id_company = 2;
    $collection = Bets::where('id_flat', $id_object)
                            ->where('id_company', $id_company)
                            ->first();
    return $collection['bet'];
});