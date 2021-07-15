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
    // set_time_limit(30000);
    // $collection_keys = CompanyName::distinct()->select('user_id','cyan_key')->get();
    // foreach($collection_keys as $collection_key){
    //     $url = 'https://public-api.cian.ru/v1/get-my-offers?source=upload&statuses=published';
    //     $curl = curl_init($url);
    //     curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Bearer ".$collection_key->cyan_key));
    //     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    //     $curl_response = curl_exec($curl);
    //     $res_published = json_decode($curl_response);
    //     curl_close($curl);
    //     if (!empty($res_published->result->announcements)) {
    //         $date = date('Y-m-d', strtotime("-1 days"));
    //         foreach ($res_published->result->announcements as $published) {
    //             $offer_id = $published->id;
    //             $stat = array();
    //             $dateFrom = $date;
    //             $dateTo = $date;
    //             $url = 'https://public-api.cian.ru/v1/get-search-coverage?dateTo='.$dateTo.'&dateFrom='.$dateFrom.'&offerId='.$offer_id;
    //             $curl = curl_init($url);
    //             curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Bearer ".$collection_key->cyan_key));
    //             curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    //             $curl_response = curl_exec($curl);
    //             $res = json_decode($curl_response,true);   
    //             curl_close($curl);
    //             if ($res['result']['offerId'] > 0) {
    //                 $stat['searches_count'] = $res['result']['searchesCount'];
    //                 $stat['shows_count'] = $res['result']['showsCount'];
    //                 $stat['coverage'] = $res['result']['coverage'];
    //             }
    //             usleep(1000);
    //             $current_url = 'https://public-api.cian.ru/v1/get-views-statistics-by-days?dateTo='.$dateTo.'&dateFrom='.$dateFrom.'&offerId='.$offer_id;
    //             $current_curl = curl_init($current_url);
    //             curl_setopt($current_curl, CURLOPT_HTTPHEADER, array("Authorization: Bearer ".$collection_key->cyan_key));
    //             for($i=0; $i<10;$i++){
    //                 curl_setopt($current_curl, CURLOPT_RETURNTRANSFER, true);
    //                 usleep(2000);
    //                 $current_curl_response = curl_exec($current_curl);
    //                 $current_res = json_decode($current_curl_response,true);
    //                 curl_close($current_curl);
    //                 if(array_key_exists("offerId",$current_res['result'])){
    //                     break;
    //                 }
    //             }
    //             if ($current_res['result']['offerId'] > 0) {
    //                 if(sizeof($current_res['result']['phoneShowsByDays']) == 0){
    //                         $stat['phone_shows'] = 0;
    //                         $stat['views'] = 0;
    //                         $stat['date'] = $date;
    //                 }
    //                 else{
    //                     $stat['phone_shows'] = $current_res['result']['phoneShowsByDays'][0]['phoneShows'];
    //                     $stat['views'] = $current_res['result']['viewsByDays'][0]['views'];
    //                     $stat['date'] = $current_res['result']['viewsByDays'][0]['date'];
    //                 }
    //             }          
    //             StatisticShows::create(array(
    //                 'id_offer'=>(int)$offer_id,
    //                 'coverage'=>$stat['coverage'],
    //                 'searches_count'=>$stat['searches_count']  ,
    //                 'shows_count'=> $stat['shows_count'],
    //                 'phone_shows'=> $stat['phone_shows'] ,
    //                 'views'=> $stat['views'],
    //                 'id_user'=> $collection_key->user_id,
    //                 'created_at' => $stat['date']
    //                 ));
    //         }
    //     }
    // }
});
Route::get('test1',function(){
    date_default_timezone_set("Europe/Moscow");
        $collection_firms = CompanyName::select('id','xml_feed','user_id')->get();
        $array_xml = [];
        $array_new = [];
        $array_xml_feed = [];
        foreach($collection_firms as $value){
            $array_xml[$value['user_id']][$value['id']] =  $value['xml_feed'];
        }
        foreach($array_xml as $index_user =>$item_xml){
            foreach($item_xml as $index_company =>$current_item_xml){
                $xml_feed= CurrentXml::select('id_flat','bet','id_user','id_company','name_agent','top')
                                    ->where('id_user', $index_user)
                                    ->where('id_company', $index_company)
                                    ->get()->toArray();
                $xml = simplexml_load_file($current_item_xml);
                $array = json_decode(json_encode($xml),TRUE);
                foreach($xml_feed as $index_xml => $current_item_feed){
                    $array_xml_feed[$current_item_feed['id_flat']]['id_company']= $current_item_feed['id_company'];
                    $array_xml_feed[$current_item_feed['id_flat']]['id_flat']= $current_item_feed['id_flat'];
                    $array_xml_feed[$current_item_feed['id_flat']]['bet']= $current_item_feed['bet'];
                    $array_xml_feed[$current_item_feed['id_flat']]['id_user']= $current_item_feed['id_user'];
                    $array_xml_feed[$current_item_feed['id_flat']]['name_agent']= $current_item_feed['name_agent'];
                    $array_xml_feed[$current_item_feed['id_flat']]['top']= $current_item_feed['top'];
                }
                $array_xml_feed_copy = $array_xml_feed;
                foreach($array['object'] as $item => $current_item) {
                    $current_array['id_flat'] = (int)$current_item['ExternalId'];
                    $current_array['id_company'] = $index_company;
                    if(array_key_exists('Bet', $current_item)){
                        $current_bet = $current_item['Bet'];
                    }else{
                        $current_bet = null;
                    }
                    $current_agent_name = $current_item['SubAgent']['FirstName'].' '.$current_item['SubAgent']['LastName'];
                    if(array_key_exists('PublishTerms', $current_item)){
                        $current_top = '';
                        $current_another_top = '';
                        if(array_key_exists('Services', $current_item['PublishTerms']['Terms']['PublishTermSchema'])){
                            $current_top = $current_item['PublishTerms']['Terms']['PublishTermSchema']['Services']['ServicesEnum'];
                        }
                        if(array_key_exists('ExcludedServices', $current_item['PublishTerms']['Terms']['PublishTermSchema'])){
                            $current_another_top = $current_item['PublishTerms']['Terms']['PublishTermSchema']['ExcludedServices']['ExcludedServicesEnum'];
                        }
                        if($current_top == "top3" or $current_another_top == "top3"){
                            $top = 1;
                        }else{
                            $top = 0;
                        }
                    }else{
                        $top = 0;
                    }
                    if(array_key_exists($current_array['id_flat'], $array_xml_feed)){
                        CurrentXml::where('id_flat', '=', $current_array['id_flat'])
                            ->where('id_company', '=', $current_array['id_company'])
                            ->where('id_user', $index_user)
                            ->update(array(
                                'bet' => $current_bet,
                                'name_agent' =>$current_agent_name,
                                'top' => $top
                            ));
                        unset($array_xml_feed[$current_array['id_flat']]);
                    }
                    else{
                        $newObject = CurrentXml::create(array(
                            'id_flat' =>$current_array['id_flat'],
                            'bet'=> $current_bet,
                            'id_user'=> $index_user,
                            'id_company'=> $current_array['id_company'],
                            'name_agent'=>$current_agent_name,
                            'top' => $top
                        ));
                        $newObject->save();
                    } 
                }
            foreach($array_xml_feed as $current_array_xml_feed_index => $current_array_xml_feed){
                CurrentXml::where('id_flat', $current_array_xml_feed_index)
                            ->where('id_user', $index_user)
                            ->where('id_company', $current_array_xml_feed['id_company'])
                            ->delete();
                Bets::where('id_flat', $current_array_xml_feed_index)
                            ->where('id_user', $index_user)
                            ->where('id_company', $current_array_xml_feed['id_company'])
                            ->delete();
                }    
            }
        }
});