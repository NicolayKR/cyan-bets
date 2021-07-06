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
    $collection = CompanyName::select('id','xml_feed')->where('user_id', Auth::user()->id)->get();
    $array_xml = [];
    foreach($collection as $value){
        $array_xml[$value['id']] =  $value['xml_feed'];
    }
    foreach($array_xml as $index =>$item_xml){
        $xml = simplexml_load_file($item_xml);
        $array = json_decode(json_encode($xml),TRUE);
        foreach($array['object'] as $item => $current_item) {
            //Текущая фирма
            if(array_key_exists('Bet', $current_item)){
                $current_bet = $current_item['Bet'];
            }else{
                $current_bet = 0;
            }
            $newData = CurrentXml::create(array(
                'id_flat' =>$current_item['ExternalId'],
                'bet'=> $current_bet,
                'name_agent' => $current_item['SubAgent']['FirstName'].' '.$current_item['SubAgent']['LastName'],
                'id_user'=> Auth::user()->id,
                'id_company'=> $index 
            ));
            $newData->save();
        }
    }
    
 });
 

 //Метод наполнения таблицы ставок в БД
Route::get('test2',function(){
    $collection = CompanyName::select('id','xml_feed')->where('user_id', Auth::user()->id)->get();
    $array_xml = [];
    foreach($collection as $value){
        $array_xml[$value['id']] =  $value['xml_feed'];
    }
    foreach($array_xml as $index =>$item_xml){
        $xml_feed= CurrentXml::select('id_flat','id_user','id_company')
                                ->where('id_user', Auth::user()->id)
                                ->where('id_company', $index)
                                ->get()->toArray();
        $xml_feed_copy = $xml_feed;
        $xml = simplexml_load_file($item_xml);
        $array = json_decode(json_encode($xml),TRUE);
        //id_flat,bet,name_agent,id_user,id_company
        foreach($array['object'] as $item => $current_item) {
            $current_array['id_flat'] = (int)$current_item['ExternalId'];
            $current_array['id_user'] = Auth::user()->id;
            $current_array['id_company'] = $index;
            if(array_key_exists('Bet', $current_item)){
                $current_bet = $current_item['Bet'];
            }else{
                $current_bet = 0;
            }
            $current_agent_name = $current_item['SubAgent']['FirstName'].' '.$current_item['SubAgent']['LastName'];
            foreach($xml_feed as $index_xml => $current_xml_feed){
                if($current_array == $current_xml_feed){
                    CurrentXml::where('id_flat', '=', $current_array['id_flat'])
                        ->where('id_company', '=', $current_array['id_company'])
                        ->where('id_user', $current_array['id_user'])
                        ->update(array(
                            'bet' => $current_bet,
                            'name_agent' =>$current_agent_name
                        ));
                    unset($xml_feed[$index_xml]);
                }
                else{
                    continue;
                }
            }
        }
        return $xml_feed;
    }
    
});