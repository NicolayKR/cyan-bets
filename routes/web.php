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
Route::get('getData','App\Http\Controllers\TableController@getData');
Route::get('getName', function(){
    return Auth::user()->name;
});
Route::resource('/accounts','App\Http\Controllers\AccountController');
Auth::routes();

Route::get('test',function(){
    $collection = CompanyName::select('id','xml_feed')->where('user_id', Auth::user()->id)->get();
    $array_xml = [];
    $array_data = [];
    foreach($collection as $value){
        $array_xml[$value['id']] =  $value['xml_feed'];
    }
    foreach($array_xml as $item => $item_xml){
        $xml = simplexml_load_file($item_xml);
        $array = json_decode(json_encode($xml),TRUE);
        foreach($array['object'] as $current_item) {
            //Ставка в СРМ
            $res_bet = Bets::select('bet')
                        ->where('id_flat', $current_item['ExternalId'])
                        ->where('id_user', Auth::user()->id)
                        ->where('id_company', $item)
                        ->first();
            $array_data[$item]['crm_bet'] = $res_bet['bet'];
            //Ставка на циан
            if(array_key_exists('Bet', $current_item)){
                $current_bet = $current_item['Bet'];
            }else{
                $current_bet = 0;
            }
            $array_data[$item]['cyan_bet'] = $current_bet;
            //Агент
            $array_data[$item]['agent'] = $current_item['SubAgent']['FirstName'].' '.$current_item['SubAgent']['LastName'];
            $array_data[$item]['id_object'] = $current_item['ExternalId'];
        }
    }
    return $array_data;
 });
 
Route::get('test2',function(){
    $collection = CompanyName::select('id','xml_feed')->where('user_id', Auth::user()->id)->get();
    $array_xml = [];
    $array_data = [];
    foreach($collection as $value){
        $array_xml[$value['id']] =  $value['xml_feed'];
    }
    foreach($array_xml as $item => $item_xml){
        $xml = simplexml_load_file($item_xml);
        $array = json_decode(json_encode($xml),TRUE);
        foreach($array['object'] as $current_item) {
            if(array_key_exists('Bet', $current_item)){
                $current_bet = $current_item['Bet'];
            }else{
                $current_bet = 0;
            }
            $newBet = Bets::create(array(
                'id_flat' =>$current_item['ExternalId'],
                'bet'=>$current_bet,
                'id_user'=> Auth::user()->id,
                'id_company'=> $item 
            ));
            $newBet->save();
        }
    }
});