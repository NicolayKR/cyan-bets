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
    set_time_limit(30000);
    $collection_keys = CompanyName::distinct()->select('user_id','cyan_key')->get();
    foreach($collection_keys as $collection_key){
        $url = 'https://public-api.cian.ru/v1/get-my-offers?source=upload&statuses=published';
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Bearer ".$collection_key->cyan_key));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $curl_response = curl_exec($curl);
        $res_published = json_decode($curl_response);
        curl_close($curl);
        if (!empty($res_published->result->announcements)) {
            $date = date('Y-m-d', strtotime("-1 days"));
            foreach ($res_published->result->announcements as $published) {
                $offer_id = $published->id;
                $stat = array();
                $dateFrom = $date;
                $dateTo = $date;
                $url = 'https://public-api.cian.ru/v1/get-search-coverage?dateTo='.$dateTo.'&dateFrom='.$dateFrom.'&offerId='.$offer_id;
                $curl = curl_init($url);
                curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Bearer ".$collection_key->cyan_key));
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                $curl_response = curl_exec($curl);
                $res = json_decode($curl_response,true);   
                curl_close($curl);
                if ($res['result']['offerId'] > 0) {
                    $stat['searches_count'] = $res['result']['searchesCount'];
                    $stat['shows_count'] = $res['result']['showsCount'];
                    $stat['coverage'] = $res['result']['coverage'];
                }
                usleep(1000);
                $current_url = 'https://public-api.cian.ru/v1/get-views-statistics-by-days?dateTo='.$dateTo.'&dateFrom='.$dateFrom.'&offerId='.$offer_id;
                $current_curl = curl_init($current_url);
                curl_setopt($current_curl, CURLOPT_HTTPHEADER, array("Authorization: Bearer ".$collection_key->cyan_key));
                for($i=0; $i<10;$i++){
                    curl_setopt($current_curl, CURLOPT_RETURNTRANSFER, true);
                    usleep(2000);
                    $current_curl_response = curl_exec($current_curl);
                    $current_res = json_decode($current_curl_response,true);
                    curl_close($current_curl);
                    if(array_key_exists("offerId",$current_res['result'])){
                        break;
                    }
                }
                if ($current_res['result']['offerId'] > 0) {
                    if(sizeof($current_res['result']['phoneShowsByDays']) == 0){
                            $stat['phone_shows'] = 0;
                            $stat['views'] = 0;
                            $stat['date'] = $date;
                    }
                    else{
                        $stat['phone_shows'] = $current_res['result']['phoneShowsByDays'][0]['phoneShows'];
                        $stat['views'] = $current_res['result']['viewsByDays'][0]['views'];
                        $stat['date'] = $current_res['result']['viewsByDays'][0]['date'];
                    }
                }          
                StatisticShows::create(array(
                    'id_offer'=>(int)$offer_id,
                    'coverage'=>$stat['coverage'],
                    'searches_count'=>$stat['searches_count']  ,
                    'shows_count'=> $stat['shows_count'],
                    'phone_shows'=> $stat['phone_shows'] ,
                    'views'=> $stat['views'],
                    'id_user'=> $collection_key->user_id,
                    'created_at' => $stat['date']
                    ));
            }
        }
    }
});
Route::get('test1',function(){
    // $array_xml = [];
    // $array_data = [];
    // $array_bets = [];
    // $date = date('Y-m-d', strtotime("-1 days"));
    // $res_bet = Bets::select('id','id_flat','id_company')->selectRaw('round(bet) as bet')
    //         ->where('id_user', Auth::user()->id)
    //         ->get();
    // foreach($res_bet as $current_bet){
    //     $array_bets[$current_bet['id_company']][$current_bet['id_flat']]['bet'] =  $current_bet['bet'];
    //     $array_bets[$current_bet['id_company']][$current_bet['id_flat']]['id'] =  $current_bet['id'];
    // }
    // $collection = DB::select('SELECT a.id,a.id_flat,a.bet,a.id_user,a.id_company,a.name_agent,a.top,
    //         b.id_offer,b.url_offer,b.current_bet,b.leader_bet,b.position,b.page, 
    //         ROUND((SUM(c.shows_count)/sum(c.searches_count))*100) as coverage,sum(c.searches_count) as searches_count,sum(c.shows_count) as shows_count,
    //         sum(phone_shows) as phone_shows,sum(views) as views
    //         FROM `current_xmls` as a
    //         left join `statistics` as b on a.id_flat = b.id_flat and a.id_user = b.id_user
    //         left join (select * from `statistic_shows` where date(created_at) BETWEEN DATE_SUB(DATE(NOW()), INTERVAL 8 DAY) and DATE(now()+ INTERVAL 1 DAY)) as c on b.id_offer = c.id_offer and a.id_user = c.id_user
    //         group by a.id,a.id_flat,a.bet,a.id_user,a.id_company,a.name_agent,a.top,
    //         b.id_offer,b.url_offer,b.current_bet,b.leader_bet,b.position,b.page');
    // foreach($collection as $index =>$item_collection){
    //     if(array_key_exists($item_collection->id_company, $array_bets)){
    //         if(array_key_exists($item_collection->id_flat, $array_bets[$item_collection->id_company])){
    //             if(array_key_exists('bet', $array_bets[$item_collection->id_company][$item_collection->id_flat])){
    //                 $array_data[$index]['crm_bet'] = (int)$array_bets[$item_collection->id_company][$item_collection->id_flat]['bet'];
    //                 $array_data[$index]['id'] = (int)$array_bets[$item_collection->id_company][$item_collection->id_flat]['id'];
    //             }
    //         }else{
    //             $array_data[$index]['crm_bet'] = 0;
    //             $array_data[$index]['id'] = $item_collection->id;
    //         }
    //     }
    //     else{
    //         $array_data[$index]['crm_bet'] = 0;
    //     }
    //     $array_data[$index]['id_offer'] = (int)$item_collection->id_offer;
    //     $array_data[$index]['url_offer'] = $item_collection->url_offer;
    //     $array_data[$index]['leader_bet'] = (int)$item_collection->leader_bet;
    //     $array_data[$index]['position'] = (int)$item_collection->position;
    //     $array_data[$index]['page'] = (int)$item_collection->page;
    //     $array_data[$index]['coverage'] = (int)$item_collection->coverage;
    //     $array_data[$index]['searches_count'] = (int)$item_collection->searches_count;
    //     $array_data[$index]['shows_count'] = (int)$item_collection->shows_count;
    //     $array_data[$index]['phone_shows'] = (int)$item_collection->phone_shows;
    //     $array_data[$index]['views'] = (int)$item_collection->views;
    //     $array_data[$index]['top'] = (int)$item_collection->top;
    //     //Текущая фирма 
    //     $array_data[$index]['id_company'] = (int)$item_collection->id_company;
    //     //Ставка на циан
    //     $array_data[$index]['cyan_bet'] = (int)$item_collection->current_bet;
    //     //Агент
    //     $array_data[$index]['agent'] = $item_collection->name_agent;
    //     $array_data[$index]['id_object'] =(int) $item_collection->id_flat;
    // }
    // return $array_data; 
   
});