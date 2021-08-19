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
Route::get('/getData','App\Http\Controllers\TableController@getData')->middleware('auth');
Route::get('/updateNow/{account}','App\Http\Controllers\XmlController@updateXml')->name('updateNow');
Route::post('/saveNewBet','App\Http\Controllers\TableController@saveNewBet')->middleware('auth');
Route::get('/getDataFromNewBet','App\Http\Controllers\TableController@getDataFromNewBet')->middleware('auth');
Route::get('getName', function(){
    return Auth::user()->name;
})->middleware('auth');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/getBalance', 'App\Http\Controllers\TableController@getBalance')->middleware('auth');
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
Route::get('test', function(){

    $toEmail = 'n.kryuchkov@enterprise-it.ru';
    $email = 'n.kryuchkov@enterprise-it.ru';
    $name = 'n.kryuchkov@enterprise-it.ru';
    $phone ='n.kryuchkov@enterprise-it.ru';
    $tariph = 'n.kryuchkov@enterprise-it.ru';
    $newMess = MailPost::create(array(
        'name'=>$name,
        'email'=>$email,
        'phone'=>$phone,
        'message'=>'Покупка тарифа:'.$tariph,
        'status'=>2
    ));
    $newMess->save();
    Mail::to($toEmail)->send(new BuyForm($name, $email, $phone, $tariph));

    
    // $final_array = [];
    // $collection = CompanyName::select('id','name','cyan_key','xml_feed','balance','auction_points','user_id')
    //             ->where('user_id','=', Auth::user()->id)->get();
    // foreach($collection as $collection_item){
    //     $final_array[$collection_item->name]['id'] = $collection_item->id;
    //     $final_array[$collection_item->name]['name'] = $collection_item->name;
    //     $final_array[$collection_item->name]['cyan_key'] = $collection_item->cyan_key;
    //     $final_array[$collection_item->name]['xml_feed'] = $collection_item->xml_feed;
    //     $final_array[$collection_item->name]['balance'] = $collection_item->balance;
    //     $final_array[$collection_item->name]['auction_points'] = $collection_item->auction_points;
    // }
    // return $final_array;
    
});