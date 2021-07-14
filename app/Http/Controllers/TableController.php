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
        if($start == null and $end== null){
            $first_date = 'DATE_SUB(DATE(NOW()), INTERVAL 8 DAY)';
            $second_date = 'DATE(now()+ INTERVAL 1 DAY)';
        }
        else{
            $first_date =  $start;
            $second_date = $end;
        }
        $array_xml = [];
        $array_data = [];
        $array_bets = [];
        $date = date('Y-m-d', strtotime("-1 days"));
        $res_bet = Bets::select('id','id_flat','id_company')->selectRaw('round(bet) as bet')
                ->where('id_user', Auth::user()->id)
                ->get();
        foreach($res_bet as $current_bet){
            $array_bets[$current_bet['id_company']][$current_bet['id_flat']]['bet'] =  $current_bet['bet'];
            $array_bets[$current_bet['id_company']][$current_bet['id_flat']]['id'] =  $current_bet['id'];
        }
        $collection = DB::select('SELECT a.id,a.id_flat,a.bet,a.id_user,a.id_company,a.name_agent,a.top,
                b.id_offer,b.url_offer,b.current_bet,b.leader_bet,b.position,b.page, 
                ROUND((SUM(c.shows_count)/sum(c.searches_count))*100) as coverage,sum(c.searches_count) as searches_count,sum(c.shows_count) as shows_count,
                sum(phone_shows) as phone_shows,sum(views) as views
                FROM `current_xmls` as a
                left join `statistics` as b on a.id_flat = b.id_flat and a.id_user = b.id_user
                left join (select * from `statistic_shows` where date(created_at) BETWEEN DATE_SUB(DATE(NOW()), INTERVAL 8 DAY) and DATE(now()+ INTERVAL 1 DAY)) as c on b.id_offer = c.id_offer and a.id_user = c.id_user
                group by a.id,a.id_flat,a.bet,a.id_user,a.id_company,a.name_agent,a.top,
                b.id_offer,b.url_offer,b.current_bet,b.leader_bet,b.position,b.page');
        foreach($collection as $index =>$item_collection){
            if(array_key_exists($item_collection->id_company, $array_bets)){
                if(array_key_exists($item_collection->id_flat, $array_bets[$item_collection->id_company])){
                    if(array_key_exists('bet', $array_bets[$item_collection->id_company][$item_collection->id_flat])){
                        $array_data[$index]['crm_bet'] = (int)$array_bets[$item_collection->id_company][$item_collection->id_flat]['bet'];
                        $array_data[$index]['id'] = (int)$array_bets[$item_collection->id_company][$item_collection->id_flat]['id'];
                    }
                }else{
                    $array_data[$index]['crm_bet'] = 0;
                    $array_data[$index]['id'] = $item_collection->id;
                }
            }
            else{
                $array_data[$index]['crm_bet'] = 0;
            }
            $array_data[$index]['id_offer'] = (int)$item_collection->id_offer;
            $array_data[$index]['url_offer'] = $item_collection->url_offer;
            $array_data[$index]['leader_bet'] = (int)$item_collection->leader_bet;
            $array_data[$index]['position'] = (int)$item_collection->position;
            $array_data[$index]['page'] = (int)$item_collection->page;
            $array_data[$index]['coverage'] = (int)$item_collection->coverage;
            $array_data[$index]['searches_count'] = (int)$item_collection->searches_count;
            $array_data[$index]['shows_count'] = (int)$item_collection->shows_count;
            $array_data[$index]['phone_shows'] = (int)$item_collection->phone_shows;
            $array_data[$index]['views'] = (int)$item_collection->views;
            $array_data[$index]['top'] = (int)$item_collection->top;
            //Текущая фирма 
            $array_data[$index]['id_company'] = (int)$item_collection->id_company;
            //Ставка на циан
            $array_data[$index]['cyan_bet'] = (int)$item_collection->current_bet;
            //Агент
            $array_data[$index]['agent'] = $item_collection->name_agent;
            $array_data[$index]['id_object'] =(int) $item_collection->id_flat;
        }
        return $array_data; 
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
}
