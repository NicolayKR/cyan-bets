<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CompanyName;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function getData(){
        $collection = CompanyName::select('name','xml_feed','cyan_key')
                                    ->where('user_id', Auth::user()->id)
                                    ->groupBy('name','xml_feed','cyan_key')
                                    ->get();
        return $collection;
    }
}
