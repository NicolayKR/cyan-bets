<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bets;
use App\Models\CurrentXml;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class HeaderController extends Controller
{
    public function getHeaderData(){
        date_default_timezone_set("Europe/Moscow");
        $sum = 0;
        $final_array = [];
        $days = Auth::user()->left_day;   
        $collection = DB::table('current_xmls')
        ->leftJoin('bets',function ($join) {
            $join->on('current_xmls.id_flat', '=', 'bets.id_flat');
            $join->on('current_xmls.id_user', '=', 'bets.id_user');})
        ->whereRaw('date(current_xmls.updated_at) = date(now())')
        ->where('current_xmls.id_user', Auth::user()->id)
        ->select('current_xmls.id_flat','current_xmls.bet')->selectRaw('bets.bet as crm_bets')->get();
        foreach($collection as $item){
            if($item->bet >= $item->crm_bets){
                $sum = $sum + $item->bet;
            }else{
                $sum = $sum + $item->crm_bets;
            }
        }
        $final_array['days_left'] = $days;
        $final_array['budget_days'] = $sum;
        $final_array['name'] = Auth::user()->name;
        return $final_array;
    }
}
