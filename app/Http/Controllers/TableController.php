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


class TableController extends Controller
{
    public function getData(){
        $array_xml = [];
        $array_data = [];
        $array_bets = [];
        $res_bet = Bets::select('id','id_flat','id_company')->selectRaw('round(bet) as bet')
                ->where('id_user', Auth::user()->id)
                ->get();
        foreach($res_bet as $current_bet){
            $array_bets[$current_bet['id_company']][$current_bet['id_flat']]['bet'] =  $current_bet['bet'];
            $array_bets[$current_bet['id_company']][$current_bet['id_flat']]['id'] =  $current_bet['id'];
        }
        $collection = CurrentXml::select('current_xmls.id','current_xmls.id_flat','bet','current_xmls.id_user','current_xmls.id_company','name_agent','top',
                'statistics.id_offer','url_offer','current_bet','leader_bet','position','page','coverage','searches_count','shows_count','phone_shows','views')
                ->leftJoin('statistics', function ($join){
                    $join->on("current_xmls.id_flat",'=',"statistics.id_flat")
                    ->on('current_xmls.id_user','=','statistics.id_user');})
                ->leftJoin('statistic_shows', function ($join){
                    $join->on("statistics.id_offer",'=',"statistic_shows.id_offer")
                        ->on('statistics.id_user','=','statistic_shows.id_user');})
                    ->get();
        foreach($collection as $index =>$item_collection){
            if(array_key_exists($item_collection['id_company'], $array_bets)){
                if(array_key_exists($item_collection['id_flat'], $array_bets[$item_collection['id_company']])){
                    if(array_key_exists('bet', $array_bets[$item_collection['id_company']][$item_collection['id_flat']])){
                        $array_data[$index]['crm_bet'] = $array_bets[$item_collection['id_company']][$item_collection['id_flat']]['bet'];
                        $array_data[$index]['id'] = $array_bets[$item_collection['id_company']][$item_collection['id_flat']]['id'];
                    }
                }else{
                    $array_data[$index]['crm_bet'] = 0;
                    $array_data[$index]['id'] = $item_collection['id'];
                }
            }
            else{
                $array_data[$index]['crm_bet'] = 0;
            }
            $array_data[$index]['id_offer'] = $item_collection['id_offer'];
            $array_data[$index]['url_offer'] = $item_collection['url_offer'];
            $array_data[$index]['leader_bet'] = $item_collection['leader_bet'];
            $array_data[$index]['position'] = $item_collection['position'];
            $array_data[$index]['page'] = $item_collection['page'];
            $array_data[$index]['coverage'] = $item_collection['coverage'];
            $array_data[$index]['searches_count'] = $item_collection['searches_count'];
            $array_data[$index]['shows_count'] = $item_collection['shows_count'];
            $array_data[$index]['phone_shows'] = $item_collection['phone_shows'];
            $array_data[$index]['views'] = $item_collection['views'];
            $array_data[$index]['top'] = $item_collection['top'];
            //Текущая фирма 
            $array_data[$index]['id_company'] = $item_collection['id_company'];
            //Ставка на циан
            $array_data[$index]['cyan_bet'] = $item_collection['current_bet'];
            //Агент
            $array_data[$index]['agent'] = $item_collection['name_agent'];
            $array_data[$index]['id_object'] = $item_collection['id_flat'];
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
