<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\TableController;
use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Auth;
use App\Models\CompanyName;
use App\Models\CyanCallPhones;
use App\Models\CurrentXml;
use App\Models\Statistic;

class updateBalance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:balance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update points and balance';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $collection_keys = CompanyName::distinct()->select('id','user_id','cyan_key')->get();
        foreach($collection_keys as $collection_key){
            $url = 'https://public-api.cian.ru/v1/get-my-balance';
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Bearer " .$collection_key->cyan_key));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $curl_response = curl_exec($curl);
            $res = json_decode($curl_response,true);
            curl_close($curl);
            CompanyName::where('id', $collection_key->id)->
                        where('user_id', $collection_key->user_id)-> 
                        where('cyan_key', $collection_key->cyan_key)->  
                        update(array(
                            'balance'=> $res['result']['totalBalance'],
                            'auction_points'=>$res['result']['auctionPoints'][0]['amount'],
                        ));
            }
    }
}
