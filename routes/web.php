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

Route::view('/','index')->middleware('auth')->name('index');
Route::view('add-form', 'add-form')->name('add-form');
Route::get('/getData','App\Http\Controllers\TableController@getData');
Route::get('/updateNow/{account}','App\Http\Controllers\XmlController@updateXml')->name('updateNow');
Route::post('/saveNewBet','App\Http\Controllers\TableController@saveNewBet');
Route::get('/getDataFromNewBet','App\Http\Controllers\TableController@getDataFromNewBet');
Route::get('getName', function(){
    return Auth::user()->name;
});
Route::resource('/accounts','App\Http\Controllers\AccountController');
Auth::routes();


Route::get('test',function(){
    $date = date('Y-m-d', strtotime("-1 days"));
    $collection = CurrentXml::select('current_xmls.id','current_xmls.id_flat','bet','current_xmls.id_user','current_xmls.id_company','name_agent','top',
                'statistics.id_offer','url_offer','current_bet','leader_bet','position','page','coverage','searches_count',
                'shows_count','phone_shows','views')->selectRaw('date(statistic_shows.created_at) as created_at')
                ->leftJoin('statistics', function ($join){
                    $join->on("current_xmls.id_flat",'=',"statistics.id_flat")
                    ->on('current_xmls.id_user','=','statistics.id_user');})
                ->leftJoin('statistic_shows', function ($join){
                    $join->on("statistics.id_offer",'=',"statistic_shows.id_offer")
                        ->on('statistics.id_user','=','statistic_shows.id_user');})
                    ->whereRaw('date(statistic_shows.created_at) = "'.$date.'"')
                    ->get();
    return $collection;
});
