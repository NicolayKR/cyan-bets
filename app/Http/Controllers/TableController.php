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
        foreach($collection as $value){
            $array_xml[$value['id']] =  $value['xml_feed'];
        }
        $res_bet = Bets::select('id','id_flat')->selectRaw('round(bet) as bet')
                            ->where('id_user', Auth::user()->id)
                            ->get();
        foreach($array_xml as $item_xml){
            $xml = simplexml_load_file($item_xml);
            $array = json_decode(json_encode($xml),TRUE);
            foreach($array['object'] as $item => $current_item) {
                //Ставка в СРМ
                foreach($res_bet as $res_bet_item){
                    if($res_bet_item['id_flat'] == $current_item['ExternalId']){
                        $array_data[$item]['crm_bet'] = $res_bet_item['bet'];
                        $array_data[$item]['id'] = $res_bet_item['id'];
                    }
                }
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
        return $request;
        //dd($request);
    }
}
