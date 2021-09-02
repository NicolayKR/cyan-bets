<?php

namespace App\Console\Commands;

use App\Models\errors_publish;
use App\Models\CompanyName;
use Illuminate\Support\Facades\Auth;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateErrors extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:errors';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update errors db';

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
        set_time_limit(15000);
        date_default_timezone_set("Europe/Moscow");
        $collection_keys = CompanyName::distinct()->select('user_id','cyan_key')->get();
        foreach($collection_keys as $collection_key){
            $collection_object = errors_publish::select('id_object')->where('id_user', $collection_key->user_id)->get();
            $array_object = [];
            foreach($collection_object as $current_object){
                $array_object[$current_object['id_object']] = $current_object['id_object'];
            }
            $url = 'https://public-api.cian.ru/v1/get-order';
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Bearer " .$collection_key->cyan_key));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $curl_response = curl_exec($curl);
            $res = json_decode($curl_response);
            curl_close($curl);
            $current_error ='';
            $current_warning = '';
        if($res->result->offers) {
            foreach ($res->result->offers as $item) {
                if ($item->externalId > 0) {
                    if(!empty($item->errors) or !empty($item->warnings)){      
                        if(empty($item->errors)){
                            $current_warning = $item->warnings[0];
                            $current_error = 'Ошибок нет';
                        }
                        if(empty($item->warnings)){
                            $current_error = $item->errors[0];
                            $current_warning = 'Предупреждений нет';
                        }
                        if(array_key_exists($item->externalId, $array_object)){
                            errors_publish::where('id_user', $collection_key->user_id)->where('id_object', $item->externalId)
                                            ->update(array(
                                                'id_offer'=>$item->offerId,
                                                'errors'=>$current_error,
                                                'warning'=>$current_warning,
                                            ));
                        }
                        else{
                            $newError = errors_publish::create(array(
                                'id_object'=>$item->externalId,
                                'id_offer'=>$item->offerId,
                                'errors'=>$current_error,
                                'warning'=>$current_warning,
                                'id_user'=>$collection_key->user_id
                            ));
                            $newError->save();
                        }
                    }
                }
            }
        }
            
        }
        errors_publish::whereRaw('date(updated_at) < DATE_SUB(DATE(NOW()), INTERVAL 8 DAY)')->delete();
    }
}
