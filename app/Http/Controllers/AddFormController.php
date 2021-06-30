<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DiDom\Document;
use DiDom\Query; 


class AddFormController extends Controller
{
    public function save(Request $request){
        $current_api = $request->input('key-cyan');
        $referer = 'http://www.google.com';
        $url = 'http://public-api.cian.ru/v1/get-my-balance';
        $header = array();
        //curl -X GET -H 'Authorization: Bearer <ACCESS TOKEN>' https://public-api.cian.ru/v1/get-my-offers?source=manual&statuses=inactive&statuses=published&usersIds=106815&usersIds=106816
        $ch_a = curl_init();
        curl_setopt($ch_a, CURLOPT_URL, $url);
        curl_setopt($ch_a, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch_a, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$current_api));
        curl_setopt($ch_a, CURLOPT_HEADER, false);
        curl_setopt($ch_a, CURLOPT_REFERER, $referer);
        $response = curl_exec($ch_a); 
        curl_close($ch_a);
        return $response;
        // $doc_page = new Document();
        // $doc_page->loadHtml($response);  
        // return $doc_page;
    }
}
