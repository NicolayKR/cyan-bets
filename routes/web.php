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
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactForm;
use App\Mail\RegisterForm;
use App\Models\MailPost;
use App\Mail\TestMail;

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
Route::view('/strategy','strategy')->middleware('auth')->name('strategy');
Route::view('/index','index')->middleware('auth')->name('index');
Route::view('/question','question')->middleware('auth')->name('question');
Route::view('/errors','errors')->middleware('auth')->name('errors');
Route::view('add-form', 'add-form')->middleware('auth')->name('add-form');
Route::get('/getData','App\Http\Controllers\TableController@getData')->middleware('auth');
Route::get('/updateNow/{account}','App\Http\Controllers\XmlController@updateXml')->name('updateNow');
Route::post('/saveNewBet','App\Http\Controllers\TableController@saveNewBet')->middleware('auth');
Route::get('/getDataFromNewBet','App\Http\Controllers\TableController@getDataFromNewBet')->middleware('auth');
Route::get('getHeaderData','App\Http\Controllers\HeaderController@getHeaderData')->middleware('auth');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/getErrors', 'App\Http\Controllers\TableController@getErrors')->middleware('auth');
Route::resource('/accounts','App\Http\Controllers\AccountController')->middleware('auth');
Route::get('/postMail', 'App\Http\Controllers\TableController@postMail')->middleware('auth');
Route::get('/regMail', 'App\Http\Controllers\TableController@regMail')->middleware('auth');
Route::get('/buyMail', 'App\Http\Controllers\TableController@buyMail')->middleware('auth');
Route::get('/login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login');
Route::get('/password/reset', 'App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('/password/email', 'App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/password/reset/{token}', 'App\Http\Controllers\Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('/password/reset', 'App\Http\Controllers\Auth\ResetPasswordController@reset')->name('password.update');
Route::get('/post', function () {
    return view('mail.test_post');
})->name('post');
Route::get('test', function(){
    date_default_timezone_set("Europe/Moscow");
    $sum = 0;
    $final_array = [];
    $d = Auth::user()->paid_month;   
    $today  = date("y-m-d");
    $dateAt = strtotime('+'.$d.' MONTH', strtotime($today));
    $lastDay = date('Y-m-d', $dateAt);
    $d1_ts = strtotime($today);
    $d2_ts = strtotime($lastDay);
    $seconds = abs($d1_ts - $d2_ts);
    $days = floor($seconds / 86400);
    $collection = DB::table('current_xmls')
    ->leftJoin('bets',function ($join) {
        $join->on('current_xmls.id_flat', '=', 'bets.id_flat');
        $join->on('current_xmls.id_user', '=', 'bets.id_user');})
    ->whereRaw('date(current_xmls.updated_at) = date(now())')
    ->where('current_xmls.id_user', Auth::user()->id)
    ->select('current_xmls.id_flat','current_xmls.bet')->selectRaw('bets.bet as crm_bets')->get();
    foreach($collection as $item){
        if($item->bet >= $item->crm_bets){
            $sum = $sum + $item->bet;
        }else{
            $sum = $sum + $item->crm_bets;
        }
    }
    $final_array['days_left'] = $days;
    $final_array['budget_days'] = $sum;
    return $final_array;
});