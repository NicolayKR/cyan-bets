<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CompanyName;
use App\Models\Bets;
use Spatie\ArrayToXml\ArrayToXml;
use Illuminate\Support\Facades\Storage;
use App\Models\CurrentXml;
use Gaarf\XmlToPhp\Convertor;

class UpdateXmlCrmFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:crmfile';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update crn xml file';

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
        $array_bets = [];
        date_default_timezone_set("Europe/Moscow");
        $collection_firms = CompanyName::select('id','xml_feed','user_id')->get();
        foreach($collection_firms as $value){
            $xml = file_get_contents($value['xml_feed']);
            Storage::put('public/'.$value['user_id'].'/'.$value['id'].'/original-xml-feed.xml', $xml);
            $contents = Storage::get('public/'.$value['user_id'].'/'.$value['id'].'/crm-xml-feed.xml');
            $resultArray = Convertor::covertToArray($contents);
            $res_bet = Bets::select('id','id_flat')->selectRaw('round(bet) as bet')
                    ->where('id_user', $value['user_id'])
                    ->where('id_company', $value['id'])
                    ->get();
            foreach($res_bet as $current_bet){
                $array_bets[$current_bet['id_flat']]['bet'] =  $current_bet['bet'];
            }
            foreach($resultArray['object'] as $res_item_index => $res_item){
                if(array_key_exists($res_item['ExternalId'], $array_bets)){     
                    $resultArray['object'][$res_item_index]['Bet'] = (string)$array_bets[$res_item['ExternalId']]['bet'];
                }

            }
            unset($resultArray['@root']);
            $result = ArrayToXml::convert($resultArray, [], true, 'UTF-8', '1.0', [], true);
            Storage::put('public/'.$value['user_id'].'/'.$value['id'].'/crm-xml-feed.xml', $result);  
        }
    }
}
