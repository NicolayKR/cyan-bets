<?php

namespace App\Http\Controllers;

use App\Models\CurrentXml;
use Illuminate\Http\Request;
use App\Models\CompanyName;
use Illuminate\Support\Facades\Auth;
use App\Models\Bets;
use Spatie\ArrayToXml\ArrayToXml;
use Illuminate\Support\Facades\Storage;
use Gaarf\XmlToPhp\Convertor;

class XmlController extends Controller
{
    public function updateXml(CompanyName $account){

        $array_bets = [];
        date_default_timezone_set("Europe/Moscow");
        $current_id = $account->id;
        $collection = CompanyName::select('xml_feed')
                            ->where('id',$current_id)
                            ->where('user_id',Auth::user()->id)
                            ->get();
        foreach($collection as $value){
            $xml = file_get_contents($value['xml_feed']);
            Storage::put('public/'.Auth::user()->id.'/'.$current_id.'/original-xml-feed.xml', $xml);
            $contents = Storage::get('public/'.Auth::user()->id.'/'.$current_id.'/crm-xml-feed.xml');
            $resultArray = Convertor::covertToArray($contents);
            $res_bet = Bets::select('id','id_flat')->selectRaw('round(bet) as bet')
                    ->where('id_user', Auth::user()->id)
                    ->where('id_company', $current_id)
                    ->get();
            foreach($res_bet as $current_bet){
                $array_bets[$current_bet['id_flat']]['bet'] =  $current_bet['bet'];
            }
            foreach($resultArray['object'] as $res_item_index => $res_item){
                if(array_key_exists($res_item['ExternalId'], $array_bets)){     
                    $resultArray['object'][$res_item_index]['Bet'] = (string)$array_bets[$res_item['ExternalId']]['bet'];
                }

            }
            unset($resultArray['@root']);
            $result = ArrayToXml::convert($resultArray, [], true, 'UTF-8', '1.0', [], true);
            Storage::put('public/'.Auth::user()->id.'/'.$current_id.'/crm-xml-feed.xml', $result);  
            $textUpdateForm = 'Обновление прошло успешно';
        }
        return redirect()->route('accounts.edit', $account)->with('status_update', $textUpdateForm);
    }
}
