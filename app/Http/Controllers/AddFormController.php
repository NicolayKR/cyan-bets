<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DiDom\Document;
use DiDom\Query; 


class AddFormController extends Controller
{
    public function save(Request $request){
        $current_api = $request->input('key-cyan');
        $ch = curl_init();
        // set url
        curl_setopt($ch, CURLOPT_URL, "https://public-api.cian.ru/v1/get-my-balance");
        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $headers = array(
            "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VySWQiOjI0MDAyODgyfQ.3xNBgSsU7UDAleK8U2znXFw8_fkcKIvMCmv-w0Dz4-c",
        );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        // $output contains the output string
        $output = curl_exec($ch);
        echo $output;
        // close curl resource to free up system resources
        curl_close($ch);
    }
}
