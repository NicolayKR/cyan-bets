<?php

namespace App\Http\Controllers;

use App\Models\CompanyName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Bets;
use App\Models\CurrentXml;
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
        $collection = CurrentXml::select('id','id_flat','bet','id_user','id_company','name_agent','top')->get();
        foreach($collection as $index =>$item_collection){
            if(array_key_exists($item_collection['id_company'], $array_bets)){
                if(array_key_exists($item_collection['id_flat'], $array_bets[$item_collection['id_company']])){
                    if(array_key_exists('bet', $array_bets[$item_collection['id_company']][$item_collection['id_flat']])){
                        $array_data[$index]['crm_bet'] = $array_bets[$item_collection['id_company']][$item_collection['id_flat']]['bet'];
                        $array_data[$index]['id'] = $array_bets[$item_collection['id_company']][$item_collection['id_flat']]['id'];
                    }
                }else{
                    $array_data[$index]['crm_bet'] = 0;
                }
            }
            else{
                $array_data[$index]['crm_bet'] = 0;
            }
            $array_data[$index]['top'] = $item_collection['top'];
            //Текущая фирма 
            $array_data[$index]['id_company'] = $item_collection['id_company'];
            //Ставка на циан
            $array_data[$index]['cyan_bet'] = $item_collection['bet'];
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
