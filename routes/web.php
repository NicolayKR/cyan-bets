<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TableController;
use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Auth;
use App\Models\CompanyName;
use App\Models\Bets;
use Spatie\ArrayToXml\ArrayToXml;
use Illuminate\Support\Facades\Storage;
use App\Models\CurrentXml;
use Gaarf\XmlToPhp\Convertor;


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
    // $array_bets = [];
    // date_default_timezone_set("Europe/Moscow");
    // $collection_firms = CompanyName::select('id','xml_feed','user_id')->get();
    // foreach($collection_firms as $value){
    //     $xml = file_get_contents($value['xml_feed']);
    //     Storage::put('public/'.$value['user_id'].'/'.$value['id'].'/original-xml-feed.xml', $xml);
    //     $contents = Storage::get('public/'.$value['user_id'].'/'.$value['id'].'/crm-xml-feed.xml');
    //     $resultArray = Convertor::covertToArray($contents);
    //     $res_bet = Bets::select('id','id_flat')->selectRaw('round(bet) as bet')
    //             ->where('id_user', $value['user_id'])
    //             ->where('id_company', $value['id'])
    //             ->get();
    //     foreach($res_bet as $current_bet){
    //         $array_bets[$current_bet['id_flat']]['bet'] =  $current_bet['bet'];
    //     }
    //     foreach($resultArray['object'] as $res_item_index => $res_item){
    //         if(array_key_exists($res_item['ExternalId'], $array_bets)){     
    //             $resultArray['object'][$res_item_index]['Bet'] = (string)$array_bets[$res_item['ExternalId']]['bet'];
    //          }

    //     }
    //     unset($resultArray['@root']);
    //     $result = ArrayToXml::convert($resultArray, [], true, 'UTF-8', '1.0', [], true);
    //     Storage::put('public/'.$value['user_id'].'/'.$value['id'].'/crm-xml-feed.xml', $result);  
    // }
 });
 


Route::get('test2',function(){
    // $current_xml = 'https://nasledie-don.ru/admin/upload/cian_flats_rnd.xml';
    // $xml = simplexml_load_file($current_xml);
    // $array = json_decode(json_encode($xml),TRUE);
    // $result = ArrayToXml::convert($array);
    // return $array;

    // Storage::put('public/1/1/original-xml-feed.xml', $xml);
    
    // $contents = Storage::get('public/1/1/crm-xml-feed.xml');
    // $resultArray = Convertor::covertToArray($contents);
    // return $resultArray;
});