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
    $array_xml = [];
    $array_data = [];
    $array_bets = [];
    // $res_bet = Bets::select('id','id_flat','id_company')->selectRaw('round(bet) as bet')
    //         ->where('id_user', Auth::user()->id)
    //         ->get();
    // foreach($res_bet as $current_bet){
    //     $array_bets[$current_bet['id_company']][$current_bet['id_flat']]['bet'] =  $current_bet['bet'];
    //     $array_bets[$current_bet['id_company']][$current_bet['id_flat']]['id'] =  $current_bet['id'];
    // }
    $msc = microtime(true);
    $collection = CurrentXml::select('id','id_flat','bet','id_user','id_company','name_agent')->get();
    $msc = microtime(true)-$msc;
    return $msc;
    // foreach($collection as $index =>$item_collection){
    //     if(array_key_exists($item_collection['id_company'], $array_bets)){
    //         if(array_key_exists($item_collection['id_flat'], $array_bets[$item_collection['id_company']])){
    //             if(array_key_exists('bet', $array_bets[$item_collection['id_company']][$item_collection['id_flat']])){
    //                 $array_data[$index]['crm_bet'] = $array_bets[$item_collection['id_company']][$item_collection['id_flat']]['bet'];
    //                 $array_data[$index]['id'] = $array_bets[$item_collection['id_company']][$item_collection['id_flat']]['id'];
    //             }
    //         }else{
    //             $array_data[$index]['crm_bet'] = 0;
    //         }
    //     }
    //     else{
    //         $array_data[$index]['crm_bet'] = 0;
    //     }
    //     //Текущая фирма 
    //     $array_data[$index]['id_company'] = $item_collection['id_company'];
    //     //Ставка на циан
    //     $array_data[$index]['cyan_bet'] = $item_collection['bet'];
    //     //Агент
    //     $array_data[$index]['agent'] = $item_collection['name_agent'];
    //     $array_data[$index]['id_object'] = $item_collection['id_flat'];
    // }
    // return $array_data; 
 });
 


Route::get('test2',function(){
    $collection_firms = CompanyName::select('id','xml_feed')->where('user_id', Auth::user()->id)->get();
    $array_xml = [];
    $array_new = [];
    $array_xml_feed = [];
    foreach($collection_firms as $value){
        $array_xml[$value['id']] =  $value['xml_feed'];
    }
    foreach($array_xml as $index =>$item_xml){
        $xml_feed= CurrentXml::select('id_flat','bet','id_user','id_company','name_agent')
                                ->where('id_user', Auth::user()->id)
                                ->where('id_company', $index)
                                ->get()->toArray();
        $xml = simplexml_load_file($item_xml);
        $array = json_decode(json_encode($xml),TRUE);
        //id_flat,bet,name_agent,id_user,id_company
        foreach($xml_feed as $index_xml => $current_xml_feed){
            $array_xml_feed[$current_xml_feed['id_flat']]['id_company']= $current_xml_feed['id_company'];
            $array_xml_feed[$current_xml_feed['id_flat']]['id_flat']= $current_xml_feed['id_flat'];
            $array_xml_feed[$current_xml_feed['id_flat']]['bet']= $current_xml_feed['bet'];
            $array_xml_feed[$current_xml_feed['id_flat']]['id_user']= $current_xml_feed['id_user'];
            $array_xml_feed[$current_xml_feed['id_flat']]['name_agent']= $current_xml_feed['name_agent'];
        }
        $array_xml_feed_copy = $array_xml_feed;
        foreach($array['object'] as $item => $current_item) {
            $current_array['id_flat'] = (int)$current_item['ExternalId'];
            $current_array['id_company'] = $index;
            if(array_key_exists('Bet', $current_item)){
                $current_bet = $current_item['Bet'];
            }else{
                $current_bet = 0;
            }
            $current_agent_name = $current_item['SubAgent']['FirstName'].' '.$current_item['SubAgent']['LastName'];
            if(array_key_exists($current_array['id_flat'], $array_xml_feed)){
                CurrentXml::where('id_flat', '=', $current_array['id_flat'])
                    ->where('id_company', '=', $current_array['id_company'])
                    ->where('id_user', Auth::user()->id)
                    ->update(array(
                        'bet' => $current_bet,
                        'name_agent' =>$current_agent_name
                    ));
                unset($array_xml_feed[$current_array['id_flat']]);
            }
            else{
                $newObject = CurrentXml::create(array(
                    'id_flat' =>$current_array['id_flat'],
                    'bet'=> $current_bet,
                    'id_user'=> Auth::user()->id,
                    'id_company'=> $current_array['id_company'],
                    'name_agent'=>$current_agent_name
                ));
                $newObject->save();
            } 
        }
        foreach($array_xml_feed as $current_array_xml_feed_index => $current_array_xml_feed){
            CurrentXml::where('id_flat', $current_array_xml_feed_index)
                        ->where('id_user', Auth::user()->id)
                        ->where('id_company', $current_array_xml_feed['id_company'])
                        ->delete();
        }    
    }
    
});