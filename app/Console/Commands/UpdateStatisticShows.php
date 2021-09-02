<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CompanyName;
use App\Models\Statistic;
use App\Models\StatisticShows;
use App\Models\User;

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
        date_default_timezone_set("Europe/Moscow");
        $collection_keys = CompanyName::distinct()->select('user_id','cyan_key')->get();
        foreach($collection_keys as $collection_key){
            $paid_user = User::select('left_day')->where('id', $collection_key->user_id)->get();
            if($paid_user[0]->left_day>0){
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
                        usleep(1000);
                        $current_url = 'https://public-api.cian.ru/v1/get-views-statistics-by-days?dateTo='.$dateTo.'&dateFrom='.$dateFrom.'&offerId='.$offer_id;
                        $current_curl = curl_init($current_url);
                        curl_setopt($current_curl, CURLOPT_HTTPHEADER, array("Authorization: Bearer ".$collection_key->cyan_key));
                        for($i=0; $i<10;$i++){
                            curl_setopt($current_curl, CURLOPT_RETURNTRANSFER, true);
                            usleep(2000);
                            $current_curl_response = curl_exec($current_curl);
                            $current_res = json_decode($current_curl_response,true);
                            curl_close($current_curl);
                            if(array_key_exists("offerId",$current_res['result'])){
                                break;
                            }
                        }
                        if ($current_res['result']['offerId'] > 0) {
                            if(sizeof($current_res['result']['phoneShowsByDays']) == 0){
                                    $stat['phone_shows'] = 0;
                                    $stat['views'] = 0;
                                    $stat['date'] = $date;
                            }
                            else{
                                $stat['phone_shows'] = $current_res['result']['phoneShowsByDays'][0]['phoneShows'];
                                $stat['views'] = $current_res['result']['viewsByDays'][0]['views'];
                                $stat['date'] = $current_res['result']['viewsByDays'][0]['date'];
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
                            'created_at' => $stat['date']
                            ));
                    }
                }
                CurrentXml::where('id_user', $collection_key->id_user)
                            ->where('id_company', $collection_key->id_company)
                            ->whereRaw('updated_at < DATE_SUB(DATE(NOW()), INTERVAL 7 DAY)')->delete();
            }
        }
    }
}
