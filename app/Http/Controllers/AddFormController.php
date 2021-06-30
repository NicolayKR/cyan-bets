<?php

namespace App\Http\Controllers;

use App\Models\CompanyName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use DiDom\Document;
use DiDom\Query; 


class AddFormController extends Controller
{
    public function save(Request $request){
        $current_api = $request->input('key-cyan');
        $current_xml = $request->input('xml-feed');
        $status_api_connect = false;
        $status_xml_connect = false;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://public-api.cian.ru/v1/get-my-balance");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $headers = array(
            "Authorization: Bearer ".$current_api."",
        );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $output = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($output, true);
        if($result['result']['totalBalance']){
            $status_api_connect = true;
        };
           //FILEGETCONTENT
        if(file_get_contents($current_xml)){
            $status_xml_connect = true;
        };
        if($status_xml_connect and $status_api_connect){
            $newCompany= CompanyName::create(array(
                'name' => $request->input('company-name'),
                'xml_feed' =>$current_xml,
                'cyan_key' =>$current_api,
                'user_id'=> Auth::user()->id
            ));
            $newCompany->save();
            $textFromForm = 'Пропишите следующую ссылку на XML фид, в Вашем личном кабинете ЦИАН: ';
            return redirect()->route('settings')->with('status', $textFromForm);
            
        };


    }
}
