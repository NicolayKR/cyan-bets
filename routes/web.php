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
Route::get('/updateNow/{account}','App\Http\Controllers\XmlController@updateXml')->name('updateNow');
Route::post('/saveNewBet','App\Http\Controllers\TableController@saveNewBet');
Route::get('/getDataFromNewBet','App\Http\Controllers\TableController@getDataFromNewBet');
Route::get('getName', function(){
    return Auth::user()->name;
});
Route::resource('/accounts','App\Http\Controllers\AccountController');
Auth::routes();

Route::get('test2',function(){
    $url = 'https://public-api.cian.ru/v1/get-my-offers?source=upload&statuses=published';
    $ACCESS_KEY = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VySWQiOjI0MDAyODgyfQ.3xNBgSsU7UDAleK8U2znXFw8_fkcKIvMCmv-w0Dz4-c';
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Bearer ".$ACCESS_KEY));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $curl_response = curl_exec($curl);
    $res_published = json_decode($curl_response);
    curl_close($curl);
    if (!empty($res_published->result->announcements)) {
        //$date = date('Y-m-d', strtotime("-1 days"));
        $date = new DateTime();
        foreach ($res_published->result->announcements as $published) {
            $offer_id = $published->id;
            $stat = array();
            $dateFrom = $date;
            $dateTo = $date;
            $url = 'https://public-api.cian.ru/v1/get-search-coverage?dateTo='.$dateTo.'&dateFrom='.$dateFrom.'&offerId='.$offer_id;
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Bearer ".$ACCESS_KEY));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $curl_response = curl_exec($curl);
            $res = json_decode($curl_response);
            curl_close($curl);
            if ($res->result->offerId > 0) {
                $stat['searches_count'] = $res->result->searchesCount;
                $stat['shows_count'] = $res->result->showsCount;
                $stat['coverage'] = $res->result->coverage;
            }
            $url = 'https://public-api.cian.ru/v1/get-views-statistics-by-days?dateTo='.$dateTo.'&dateFrom='.$dateFrom.'&offerId='.$offer_id;
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Bearer ".$ACCESS_KEY));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $curl_response = curl_exec($curl);
            $res = json_decode($curl_response,true);
            curl_close($curl);
            return $res;
            if ($res->result->offerId > 0) {
                $stat['phone_shows'] = $res->result->phoneShowsByDays[0]->phoneShows;
                $stat['views'] = $res->result->viewsByDays[0]->views;
            }
            $set = array('`offer_id` = "'.$offer_id.'"', '`idx` = "'.$arr_offer_to_idx[$offer_id].'"', '`date` = "'.$date.'"');

            foreach ($stat as $key => $val) {
                $set[] = ' `'.$key.'` = "'.$val.'" ';
            }

            $sql = 'INSERT INTO `statistic_cian_coverage` SET '.implode(', ', $set);
            
        }

    }
});

Route::get('test',function(){
    $date = new DateTime('-2 days');
    $startTime =  $date->format('Y-m-d');
    $collection_keys = CompanyName::select('id','cyan_key','user_id')->get();
    foreach($collection_keys as $collection_key){
        $url = 'https://public-api.cian.ru/v1/get-calls-report?page=1&pageSize=100&dateFrom='.$startTime; //?startTime=2019-01-10
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Bearer ".$collection_key->cyan_key));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $curl_response = curl_exec($curl);
        $res = json_decode($curl_response);
        curl_close($curl);
        if ($res->result->calls) {
            $ar_calls = array_reverse($res->result->calls);
            foreach ($ar_calls as $call) {
                $phone = preg_replace('/\D+/', '', $call->sourcePhone);
                CyanCallPhones::create(array(
                    'phone'=>$phone,
                    'called'=>$call->date,
                    'id_user'=>$collection_key->user_id,
                    'id_company'=>$collection_key->id
                    ));
                }
            }
        }
 });
Route::get('test1',function(){
    $collection_keys = CompanyName::select('id','cyan_key','user_id')->get();
    foreach($collection_keys as $collection_key){
        $url = 'https://public-api.cian.ru/v1/get-order';
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Bearer " .$collection_key->cyan_key));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $curl_response = curl_exec($curl);
        $res = json_decode($curl_response);
        curl_close($curl);
        $ar_offerIds = array();
        $x_auction = 0;
        $y_auction = 0;
        $collectionExtID = Statistic::select('id_flat','id_offer','url_offer')->where('id_company', $collection_key->id)->get();
        $array_statistic = array();
        $array_statistic_from_db = array();
        foreach($collectionExtID as $collectionExtIdItem){
            $array_statistic_from_db[$collectionExtIdItem['id_offer']]['id_flat'] = $collectionExtIdItem['id_flat'];
            $array_statistic_from_db[$collectionExtIdItem['id_offer']]['url_offer'] = $collectionExtIdItem['url_offer'];
        }
        if ($res->result->offers) {
            foreach ($res->result->offers as $item) {
                if ($item->externalId > 0) {
                    $offer_id = $item->offerId;
                    if($offer_id != null){
                        if(!array_key_exists($offer_id, $array_statistic)){
                            $array_statistic[$offer_id]['id_flat'] = $item->externalId;
                            $array_statistic[$offer_id]['url_offer'] = $item->url;
                        }
                        $ar_offerIds[$x_auction][$y_auction++] = 'offerIds='.$offer_id;
                        if ($y_auction >= 20) {
                            $x_auction++;
                            $y_auction = 0;
                        }
                    }
                }
            }
        }
        if (!empty($ar_offerIds)) {
            foreach ($ar_offerIds as $offerIds) {
                $url = 'https://public-api.cian.ru/v1/get-auction?'.implode('&', $offerIds);
                $curl = curl_init($url);
                curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Bearer " . $collection_key->cyan_key));
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                $curl_response = curl_exec($curl);
                $res_auction = json_decode($curl_response);
                curl_close($curl);
                if (!empty($res_auction->result->items)) {
                    foreach ($res_auction->result->items as $a) {
                        if($a->currentBet == null){
                            $current_bet = 0;
                        }
                        else{
                            $current_bet = $a->currentBet;
                        }
                        if($a->leaderBet == null){
                            $leaderBet  = 0;
                        }
                        else{
                            $leaderBet  = $a->leaderBet ;
                        }
                        if(!array_key_exists($a->offerId, $array_statistic_from_db)){
                            Statistic::create(array(
                                'id_flat'=>$array_statistic[$a->offerId]['id_flat'],
                                'id_offer'=>(int)$a->offerId,
                                'url_offer'=>$array_statistic[$a->offerId]['url_offer'],
                                'current_bet'=>$current_bet,
                                'leader_bet'=>$leaderBet ,
                                'position'=> $a->position,
                                'page'=>$a->page,
                                'id_user'=>$collection_key->user_id,
                                'id_company'=>$collection_key->id
                                ));
                        }
                        else{
                            Statistic::where('id_user', $collection_key->id_user)->
                                        where('id_flat', $array_statistic[$a->offerId]['id_flat'])-> 
                                        where('id_offer', (int)$a->offerId)->  
                                        where('id_user', $collection_key->user_id)-> 
                                        where('id_company', $collection_key->id)->     
                                        update(array(
                                            'url_offer'=>$array_statistic[$a->offerId]['url_offer'],
                                            'current_bet'=>$current_bet,
                                            'leader_bet'=>$leaderBet ,
                                            'position'=> $a->position,
                                            'page'=>$a->page,
                                        ));
                        }
                    }
                }
            }
        }
    }
});
