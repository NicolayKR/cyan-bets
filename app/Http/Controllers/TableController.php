<?php

namespace App\Http\Controllers;

use App\Models\CompanyName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Bets;
use DiDom\Document;
use DiDom\Query; 


class TableController extends Controller
{
    public function getData(){
        $collection = CompanyName::select('id','xml_feed')->where('user_id', Auth::user()->id)->get();
        $array_xml = [];
        $array_data = [];
        $array_bets = [];
        foreach($collection as $value){
            $array_xml[$value['id']] =  $value['xml_feed'];
        }
        $res_bet = Bets::select('id','id_flat','id_company')->selectRaw('round(bet) as bet')
                ->where('id_user', Auth::user()->id)
                ->get();
        foreach($res_bet as $current_bet){
            $array_bets[$current_bet['id_company']][$current_bet['id_flat']]['bet'] =  $current_bet['bet'];
            $array_bets[$current_bet['id_company']][$current_bet['id_flat']]['id'] =  $current_bet['id'];
        }
        foreach($array_xml as $index =>$item_xml){
            $xml = simplexml_load_file($item_xml);
            $array = json_decode(json_encode($xml),TRUE);
            foreach($array['object'] as $item => $current_item) {
                //Ставка в СРМ
                if(array_key_exists($index, $array_bets)){
                    if(array_key_exists($current_item['ExternalId'], $array_bets[$index])){
                        if(array_key_exists('bet', $array_bets[$index][$current_item['ExternalId']])){
                            $array_data[$item]['crm_bet'] = $array_bets[$index][$current_item['ExternalId']]['bet'];
                            $array_data[$item]['id'] = $array_bets[$index][$current_item['ExternalId']]['id'];
                        }
                    }else{
                        $array_data[$item]['crm_bet'] = 0;
                    }
                }
                else{
                    $array_data[$item]['crm_bet'] = 0;
                }
                //Текущая фирма 
                $array_data[$item]['id_company'] = $index;
                //Ставка на циан
                if(array_key_exists('Bet', $current_item)){
                    $current_bet = $current_item['Bet'];
                }else{
                    $current_bet = 0;
                }
                $array_data[$item]['cyan_bet'] = $current_bet;
                //Агент
                $array_data[$item]['agent'] = $current_item['SubAgent']['FirstName'].' '.$current_item['SubAgent']['LastName'];
                $array_data[$item]['id_object'] = $current_item['ExternalId'];
            }
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
