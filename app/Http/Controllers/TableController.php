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
    public function getData(Request $request){
        $collection = CompanyName::select('id','xml_feed')->where('user_id', Auth::user()->id)->get();
        $array_xml = [];
        $array_data = [];
        foreach($collection as $value){
            $array_xml[$value['id']] =  $value['xml_feed'];
        }
        foreach($array_xml as $item => $item_xml){
            $xml = simplexml_load_file($item_xml);
            $array = json_decode(json_encode($xml),TRUE);
            foreach($array['object'] as $current_item) {
                //Ставка в СРМ
                $res_bet = Bets::select('bet')
                            ->where('id_flat', $current_item['ExternalId'])
                            ->where('id_user', Auth::user()->id)
                            ->where('id_company', $item)
                            ->get();
                $crm_bet = $res_bet[0]['bet'];
                $array_data[$item]['crm_bet'] = $crm_bet;
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
}
