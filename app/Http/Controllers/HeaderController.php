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
        if($days == null){
            $d = Auth::user()->paid_month;
            $today  = date("y-m-d");
            $dateAt = strtotime('+'.$d.' MONTH', strtotime($today));
            $lastDay = date('Y-m-d', $dateAt);
            $d1_ts = strtotime($today);
            $d2_ts = strtotime($lastDay);
            $seconds = abs($d1_ts - $d2_ts);
            $final_array['days_left'] = floor($seconds / 86400);
        }else{
            $final_array['days_left'] = $days;
        }
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
        $final_array['logo'] = '/assets/img/logo_'.Auth::user()->id.'_cl.png';
        $final_array['budget_days'] = $sum;
        $final_array['name'] = Auth::user()->name;
        return $final_array;
    }
}
