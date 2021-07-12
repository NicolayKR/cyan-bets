<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CompanyName;
use App\Models\Statistic;
use App\Models\StatisticShows;

class UpdateStatisticShows extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:statistic_shows';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update statistic shows from db';

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
        set_time_limit(30000);
        $collection_keys = CompanyName::distinct()->select('user_id','cyan_key')->get();
        foreach($collection_keys as $collection_key){
            $url = 'https://public-api.cian.ru/v1/get-my-offers?source=upload&statuses=published';
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Bearer ".$collection_key->cyan_key));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $curl_response = curl_exec($curl);
            $res_published = json_decode($curl_response);
            curl_close($curl);
            if (!empty($res_published->result->announcements)) {
                $date = date('Y-m-d', strtotime("-1 days"));
                foreach ($res_published->result->announcements as $published) {
                    $offer_id = $published->id;
                    $stat = array();
                    $dateFrom = $date;
                    $dateTo = $date;
                    $url = 'https://public-api.cian.ru/v1/get-search-coverage?dateTo='.$dateTo.'&dateFrom='.$dateFrom.'&offerId='.$offer_id;
                    $curl = curl_init($url);
                    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Bearer ".$collection_key->cyan_key));
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    $curl_response = curl_exec($curl);
                    $res = json_decode($curl_response,true);   
                    curl_close($curl);
                    if ($res['result']['offerId'] > 0) {
                        $stat['searches_count'] = $res['result']['searchesCount'];
                        $stat['shows_count'] = $res['result']['showsCount'];
                        $stat['coverage'] = $res['result']['coverage'];
                    }
                    $url = 'https://public-api.cian.ru/v1/get-views-statistics-by-days?dateTo='.$dateTo.'&dateFrom='.$dateFrom.'&offerId='.$offer_id;
                    $curl = curl_init($url);
                    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Bearer ".$collection_key->cyan_key));
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    $curl_response = curl_exec($curl);
                    $res = json_decode($curl_response,true);
                    curl_close($curl);
                    if ($res['result']['offerId'] > 0) {
                        if(sizeof($res['result']['phoneShowsByDays']) == 0){
                                $stat['phone_shows'] = 0;
                                $stat['views'] = 0;
                        }
                        else{
                                $stat['phone_shows'] = $res['result']['phoneShowsByDays'][0]['phoneShows'];
                                $stat['views'] = $res['result']['viewsByDays'][0]['views'];
                        }
                    }          
                    StatisticShows::create(array(
                        'id_offer'=>(int)$offer_id,
                        'coverage'=>$stat['coverage'],
                        'searches_count'=>$stat['searches_count']  ,
                        'shows_count'=> $stat['shows_count'],
                        'phone_shows'=> $stat['phone_shows'] ,
                        'views'=> $stat['views'],
                        'id_user'=> $collection_key->user_id,
                        ));
                }
            }
        }
    }
}
