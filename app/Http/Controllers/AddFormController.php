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
    public function update(Request $request){
        $name = $request->input('name');
        $current_api = $request->input('key-cyan');
        $current_xml = $request->input('xml-feed');
        dd($request);
        
    }
}
