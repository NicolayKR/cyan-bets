<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PhoneController extends Controller
{
     public function getPhoneFromTwoDays(){
        $date = new DateTime('-2 days');
        $startTime =  $date->format('Y-m-d');
        $collection_keys = CompanyName::select('id','cyan_key','user_id')->get();
        foreach($collection_keys as $collection_key){
            $url = 'https://public-api.cian.ru/v1/get-calls-report?page=1&pageSize=100&dateFrom='.$startTime; //?startTime=2019-01-10
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Bearer ".$collection_key->cyan_key));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $curl_response = curl_exec($curl);
            $res = json_decode($curl_response);
            curl_close($curl);
            if ($res->result->calls) {
                $ar_calls = array_reverse($res->result->calls);
                foreach ($ar_calls as $call) {
                    $phone = preg_replace('/\D+/', '', $call->sourcePhone);
                    CyanCallPhones::create(array(
                        'phone'=>$phone,
                        'called'=>$call->date,
                        'id_user'=>$collection_key->user_id,
                        'id_company'=>$collection_key->id
                        ));
                    }
                }
            }
     }
}
