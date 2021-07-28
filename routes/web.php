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
Route::view('/question','question')->middleware('auth')->name('question');
Route::view('add-form', 'add-form')->middleware('auth')->name('add-form');
Route::get('/getData','App\Http\Controllers\TableController@getData');
Route::get('/updateNow/{account}','App\Http\Controllers\XmlController@updateXml')->name('updateNow');
Route::post('/saveNewBet','App\Http\Controllers\TableController@saveNewBet');
Route::get('/getDataFromNewBet','App\Http\Controllers\TableController@getDataFromNewBet');
Route::get('getName', function(){
    return Auth::user()->name;
});
Route::resource('/accounts','App\Http\Controllers\AccountController');
Auth::routes();

Route::get('test', function(){
    // date_default_timezone_set("Europe/Moscow");
    //     $collection_firms = CompanyName::select('id','xml_feed','user_id')->get();
    //     $array_xml = [];
    //     $array_new = [];
    //     $array_xml_feed = [];
    //     foreach($collection_firms as $value){
    //         $array_xml[$value['user_id']][$value['id']] =  $value['xml_feed'];
    //     }
    //     foreach($array_xml as $index_user =>$item_xml){
    //         foreach($item_xml as $index_company =>$current_item_xml){
    //             $xml_feed= CurrentXml::select('id_flat','bet','id_user','price','id_company','name_agent','top')
    //                                 ->where('id_user', $index_user)
    //                                 ->where('id_company', $index_company)
    //                                 ->get()->toArray();
    //             $xml = simplexml_load_file($current_item_xml);
    //             $array = json_decode(json_encode($xml),TRUE);
    //             foreach($xml_feed as $index_xml => $current_item_feed){
    //                 $array_xml_feed[$current_item_feed['id_flat']]['id_company']= $current_item_feed['id_company'];
    //                 $array_xml_feed[$current_item_feed['id_flat']]['id_flat']= $current_item_feed['id_flat'];
    //                 $array_xml_feed[$current_item_feed['id_flat']]['bet']= $current_item_feed['bet'];
    //                 $array_xml_feed[$current_item_feed['id_flat']]['id_user']= $current_item_feed['id_user'];
    //                 $array_xml_feed[$current_item_feed['id_flat']]['name_agent']= $current_item_feed['name_agent'];
    //                 $array_xml_feed[$current_item_feed['id_flat']]['price']= $current_item_feed['price'];
    //                 $array_xml_feed[$current_item_feed['id_flat']]['top']= $current_item_feed['top'];
    //             }
    //             $array_xml_feed_copy = $array_xml_feed;
    //             foreach($array['object'] as $item => $current_item) {
    //                 $current_array['id_flat'] = (int)$current_item['ExternalId'];
    //                 $current_array['price'] = (int)$current_item['BargainTerms']['Price'];
    //                 $current_array['id_company'] = $index_company;
    //                 if(array_key_exists('Auction', $current_item)){
    //                     if(array_key_exists('Bet', $current_item['Auction'])){
    //                         $current_bet = $current_item['Auction']['Bet'];
    //                     }
    //                 }else{
    //                     $current_bet = null;
    //                 }
    //                 $current_agent_name = $current_item['SubAgent']['FirstName'].' '.$current_item['SubAgent']['LastName'];
    //                 if(array_key_exists('PublishTerms', $current_item)){
    //                     $current_top = '';
    //                     $current_another_top = '';
    //                     if(array_key_exists('Services', $current_item['PublishTerms']['Terms']['PublishTermSchema'])){
    //                         $current_top = $current_item['PublishTerms']['Terms']['PublishTermSchema']['Services']['ServicesEnum'];
    //                     }
    //                     if(array_key_exists('ExcludedServices', $current_item['PublishTerms']['Terms']['PublishTermSchema'])){
    //                         $current_another_top = $current_item['PublishTerms']['Terms']['PublishTermSchema']['ExcludedServices']['ExcludedServicesEnum'];
    //                     }
    //                     if($current_top == "top3" or $current_another_top == "top3"){
    //                         $top = 1;
    //                     }else{
    //                         $top = 0;
    //                     }
    //                 }else{
    //                     $top = 0;
    //                 }
    //                 if(array_key_exists($current_array['id_flat'], $array_xml_feed)){
    //                     CurrentXml::where('id_flat', '=', $current_array['id_flat'])
    //                         ->where('id_company', '=', $current_array['id_company'])
    //                         ->where('id_user', $index_user)
    //                         ->update(array(
    //                             'bet' => $current_bet,
    //                             'name_agent' =>$current_agent_name,
    //                             'price'=> $current_array['price'],
    //                             'top' => $top
    //                         ));
    //                     unset($array_xml_feed[$current_array['id_flat']]);
    //                 }
    //                 else{
    //                     $newObject = CurrentXml::create(array(
    //                         'id_flat' =>$current_array['id_flat'],
    //                         'bet'=> $current_bet,
    //                         'id_user'=> $index_user,
    //                         'id_company'=> $current_array['id_company'],
    //                         'price' => $current_array['price'],
    //                         'name_agent'=>$current_agent_name,
    //                         'top' => $top
    //                     ));
    //                     $newObject->save();
    //                 } 
    //             }
    //         foreach($array_xml_feed as $current_array_xml_feed_index => $current_array_xml_feed){
    //             CurrentXml::where('id_flat', $current_array_xml_feed_index)
    //                         ->where('id_user', $index_user)
    //                         ->where('id_company', $current_array_xml_feed['id_company'])
    //                         ->delete();
    //             Bets::where('id_flat', $current_array_xml_feed_index)
    //                         ->where('id_user', $index_user)
    //                         ->where('id_company', $current_array_xml_feed['id_company'])
    //                         ->delete();
    //             }    
    //         }
    //     }
});
