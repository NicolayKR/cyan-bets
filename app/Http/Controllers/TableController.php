<?php

namespace App\Http\Controllers;

use App\Models\CompanyName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Bets;
use App\Models\CurrentXml;
use App\Models\Statistic;
use App\Models\StatisticShows;
use DiDom\Document;
use DiDom\Query; 
use Illuminate\Support\Facades\DB;


class TableController extends Controller
{
    public function getData(Request $request){
        $start = $request->query('start'); 
        $end = $request->query('end'); 
        if($start == 'null' and $end== 'null'){
            $first_date = 'DATE_SUB(DATE(NOW()), INTERVAL 9 DAY)';
            $second_date = 'DATE(now()+ INTERVAL 1 DAY)';
        }
        elseif($end== 'null'){
            $first_date =  "'".(string)$start."'";
            $second_date = 'DATE(now()+ INTERVAL 1 DAY)';
        }
        else{
            $first_date =  "'".(string)$start."'";
            $second_date = "'".(string)$end."'";
        }
        $array_xml = [];
        $array_data = [];
        $array_bets = [];
        $lenght_auction = 0;
        $date = date('Y-m-d', strtotime("-1 days"));
        $res_bet = Bets::select('id','id_flat','id_company')->selectRaw('round(bet) as bet')
                ->where('id_user', Auth::user()->id)
                ->get();
        foreach($res_bet as $current_bet){
            $array_bets[$current_bet['id_company']][$current_bet['id_flat']]['bet'] =  $current_bet['bet'];
            $array_bets[$current_bet['id_company']][$current_bet['id_flat']]['id'] =  $current_bet['id'];
        }
        $collection = DB::select('SELECT a.id,a.id_flat,a.bet,a.id_user,a.id_company,a.name_agent,a.top,a.price,
            b.id_offer,b.url_offer,b.current_bet,b.leader_bet,b.position,b.page, 
            ROUND((SUM(c.shows_count)/sum(c.searches_count))*100) as coverage,sum(c.searches_count) as searches_count,sum(c.shows_count) as shows_count,
            sum(phone_shows) as phone_shows,sum(views) as views
            FROM `current_xmls` as a
            left join `statistics` as b on a.id_flat = b.id_flat and a.id_user = b.id_user
            left join `statistic_shows` as c on b.id_offer = c.id_offer and a.id_user = c.id_user
            and date(c.created_at) BETWEEN '.$first_date.' and '.$second_date.'
            where a.id_user = '.Auth::user()->id.'
            group by a.id,a.id_user,b.id_offer,b.url_offer,b.current_bet,b.leader_bet,b.position,b.page');
        if(sizeof($collection) == 0){
            return 0;
        }
        else{
            foreach($collection as $index =>$item_collection){
                if(array_key_exists($item_collection->id_company, $array_bets)){
                    if(array_key_exists($item_collection->id_flat, $array_bets[$item_collection->id_company])){
                        if(array_key_exists('bet', $array_bets[$item_collection->id_company][$item_collection->id_flat])){
                            $array_data['table_data'][$index]['crm_bet'] = (int)$array_bets[$item_collection->id_company][$item_collection->id_flat]['bet'];
                            $array_data['table_data'][$index]['id'] = $item_collection->id;
                        }
                    }else{
                        $array_data['table_data'][$index]['crm_bet'] = 0;
                        $array_data['table_data'][$index]['id'] = $item_collection->id;
                    }
                }
                else{
                    $array_data['table_data'][$index]['crm_bet'] = 0;
                }
                $array_data['table_data'][$index]['auction'] = (int)$item_collection->bet;
                if((int)$item_collection->current_bet != 0){
                    $lenght_auction++;
                }
                $array_data['table_data'][$index]['price'] = (int)$item_collection->price;
                $array_data['table_data'][$index]['id_offer'] = (int)$item_collection->id_offer;
                $array_data['table_data'][$index]['url_offer'] = $item_collection->url_offer;
                $array_data['table_data'][$index]['leader_bet'] = (int)$item_collection->leader_bet;
                $array_data['table_data'][$index]['position'] = (int)$item_collection->position;
                $array_data['table_data'][$index]['page'] = (int)$item_collection->page;
                $array_data['table_data'][$index]['coverage'] = (int)$item_collection->coverage;
                $array_data['table_data'][$index]['searches_count'] = (int)$item_collection->searches_count;
                $array_data['table_data'][$index]['shows_count'] = (int)$item_collection->shows_count;
                $array_data['table_data'][$index]['phone_shows'] = (int)$item_collection->phone_shows;
                $array_data['table_data'][$index]['views'] = (int)$item_collection->views;
                $array_data['table_data'][$index]['top'] = (int)$item_collection->top;
                //Текущая фирма 
                $array_data['table_data'][$index]['id_company'] = (int)$item_collection->id_company;
                //Ставка на циан
                $array_data['table_data'][$index]['cyan_bet'] = (int)$item_collection->current_bet;
                //Агент
                $array_data['table_data'][$index]['agent'] = $item_collection->name_agent;
                $array_data['table_data'][$index]['id_object'] =(int) $item_collection->id_flat;
            
            }
            $collection_statistic = DB::table('current_xmls')
                ->leftJoin('statistics',function ($join) {
                    $join->on('current_xmls.id_flat', '=', 'statistics.id_flat');
                    $join->on('current_xmls.id_user', '=', 'statistics.id_user');})
                ->leftJoin('statistic_shows',function ($join) {
                    $join->on('statistics.id_offer', '=', 'statistic_shows.id_offer');
                    $join->on('current_xmls.id_user', '=', 'statistic_shows.id_user');})
                ->whereRaw('date(statistic_shows.created_at) BETWEEN '.$first_date.' and '.$second_date.'')
                ->where('current_xmls.id_user','=', Auth::user()->id)
                ->selectRaw('sum(shows_count) as shows_count,sum(phone_shows) as phone_shows,sum(views) as views')
                ->get();
            $array_data['shows_count'] = (int)$collection_statistic[0]->shows_count;
            $array_data['phone_shows'] = (int)$collection_statistic[0]->phone_shows;
            $array_data['views'] = (int)$collection_statistic[0]->views;
            $array_data['lenght_auction'] = $lenght_auction;
            $collection_statistic = DB::table('current_xmls')
            ->leftJoin('statistics',function ($join) {
                $join->on('current_xmls.id_flat', '=', 'statistics.id_flat');
                $join->on('current_xmls.id_user', '=', 'statistics.id_user');})
            ->leftJoin('statistic_shows',function ($join) {
                $join->on('statistics.id_offer', '=', 'statistic_shows.id_offer');
                $join->on('current_xmls.id_user', '=', 'statistic_shows.id_user');})
            ->whereRaw('date(statistic_shows.created_at) BETWEEN '.$first_date.' and '.$second_date.'')
            ->where('current_xmls.id_user', Auth::user()->id)
            ->selectRaw('date(statistic_shows.created_at) as created_at, sum(shows_count) as shows_count,sum(phone_shows) as phone_shows,sum(views) as views')
            ->groupBy('created_at')
            ->get();
            $chartdata = array();
            $array_shows = array();
            $array_phone = array();
            $array_views = array();
            foreach($collection_statistic as $collection_item){
                $chartdata['labels'][] = $collection_item->created_at;
                array_push($array_shows,$collection_item->shows_count);
                array_push($array_phone,$collection_item->phone_shows);
                array_push($array_views,$collection_item->views);
            }
            //Сборка объектов линий
            $arrayData = array();
            $object1 = array();
            $object1['label'] ='Показов объявлений';
            $object1['backgroundColor'] ='#2b87db';
            $object1['borderColor'] ='#2b87db';
            //$object1['borderWidth'] = 2;
            $object1['fill'] = false;
            $object1['data'] =$array_shows;
            $object1['pointRadius'] = 4;
            array_push($arrayData, $object1);
            $object3 = array();
            $object3['label'] ='Просмотров объявлений';
            $object3['backgroundColor'] ='rgb(243, 150, 70)';
            $object3['borderColor'] ='rgb(243, 150, 70)';
            $object3['fill'] = false;
            $object3['data'] =$array_views;
            $object3['pointRadius'] = 4;
            array_push($arrayData, $object3);
            $object2 = array();
            $object2['label'] ='Показов телефонов';
            $object2['backgroundColor'] ='#DC143C';
            $object2['borderColor'] ='#DC143C';
            $object2['fill'] = false;
            $object2['data'] =$array_phone;
            $object2['pointRadius'] = 4;
            array_push($arrayData, $object2);
            $chartdata['datasets'] = $arrayData;
            $array_data['datacollection'] = $chartdata;
            return $array_data; 
        }
    }
    public function saveNewBet(Request $request){
        $currentBets = $request->all();
        $bet = $currentBets['bet'];
        $id = $currentBets['id_object'];
        $id_company = $currentBets['id_company'];
        $result = Bets::select(Bets::raw('COUNT(*)'))
                        ->where('id_flat', $id)
                        ->where('id_company', $id_company)
                        ->where('id_user', Auth::user()->id)
                        ->count(); 
        if($result == 1 ){
            Bets::where('id_flat', '=', $id)->
                    where('id_company', '=', $id_company)-> 
                    where('id_user', Auth::user()->id)->
                    update(array('bet' => $bet));
        }
        else{
            $newBet = Bets::create(array(
                'id_flat' =>$id,
                'bet'=> $bet,
                'id_user'=> Auth::user()->id,
                'id_company'=> $id_company 
            ));
            $newBet->save();
        }
        return $currentBets;
    }
    public function getDataFromNewBet(Request $request){
        $id_object = $request->query('id_object');
        $id_company = $request->query('id_company');
        $collection = Bets::where('id_flat', $id_object)
                                ->where('id_company', $id_company)
                                ->where('id_user', Auth::user()->id)
                                ->first();
        return $collection['bet'];
    }
    public function getBalance(){
        $collection_keys = CompanyName::distinct()->select('cyan_key')
                                    ->where('user_id',Auth::user()->id)->get();
        $balance = 0;
        $auction_points = 0;
        $array_data = [];
        foreach($collection_keys as $collection_key){
            $current_item = CompanyName::select('balance','auction_points')
                        ->where('cyan_key', $collection_key['cyan_key'])->get();
            $balance = $balance + $current_item[0]['balance'];
            $auction_points = $auction_points + $current_item[0]['auction_points'];
        }
        $array_data['balance'] = $balance;
        $array_data['auction_points'] = $auction_points; 
        return $array_data; 
    }
}
