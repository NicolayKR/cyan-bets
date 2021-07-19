<?php

namespace App\Http\Controllers;

use App\Models\CompanyName;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\ArrayToXml\ArrayToXml;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\TableController;
use App\Models\Bets;
use App\Models\CurrentXml;
use App\Models\Statistic;
use App\Models\StatisticShows;
use Gaarf\XmlToPhp\Convertor;
use Illuminate\Support\Facades\DB;


class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('account', [
            'accounts' => CompanyName::select('id','name','cyan_key','xml_feed','user_id')
                ->where('user_id','=', Auth::user()->id)->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add-form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $current_api = $request->input('key_cyan');
        $current_xml = $request->input('xml_feed');
        $status_api_connect = false;
        $status_xml_connect = false;
        $textFromForm = '';
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
        $contents = @file_get_contents($current_xml);
        if (array_key_exists('totalBalance', $result['result'])) {
            $status_api_connect = true;
        }else{
            $textFromForm = 'Некорректный ключ к ЦИАН';
        }
        if(false !== $contents){
            $status_xml_connect = true;
        }
        else{
            if($status_api_connect == false){
                $textFromForm = $textFromForm.', некорректный XML фид ЦИАН';
            }
            else{
                $textFromForm = 'Некорректный XML фид ЦИАН';
            }
        }
        $contents = json_encode($contents);
        if($status_xml_connect and $status_api_connect){        
            $newCompany= CompanyName::create(array(
                'name' => $request->input('company_name'),
                'xml_feed' =>$current_xml,
                'cyan_key' =>$current_api,
                'user_id'=> Auth::user()->id 
            ));
            $newCompany->save();
            $xml = file_get_contents($current_xml);
            $res = CompanyName::select('id')->where('cyan_key', $current_api)
                                            ->where('xml_feed', $current_xml)
                                            ->where('user_id','=', Auth::user()->id)
                                            ->get();
            $id_user = $res[0]['id'];
            Storage::put('public/'.Auth::user()->id.'/'.$id_user.'/original-xml-feed.xml', $xml);
            Storage::put('public/'.Auth::user()->id.'/'.$id_user.'/crm-xml-feed.xml', $xml);
            $url = url(Storage::url('public/'.Auth::user()->id.'/'.$id_user.'/crm-xml-feed.xml'));
            $this->updateCurrentXmlBD();
            $textFromForm = 'Пропишите следующую ссылку на XML фид, в Вашем личном кабинете ЦИАН:'.$url;
            return redirect()->route('accounts.edit', $newCompany)->with('status', $textFromForm);  
        }
        else{
            return redirect()->route('accounts.create')->with('status', $textFromForm);  
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CompanyName  $account
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyName $account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CompanyName  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(CompanyName $account)
    {
        $res = CompanyName::select('id')->where('cyan_key', $account->cyan_key)
                                        ->where('xml_feed', $account->xml_feed)
                                        ->where('user_id','=', Auth::user()->id)
                                        ->get();
        $id_user = $res[0]['id'];
        $url = url(Storage::url('public/'.Auth::user()->id.'/'.$id_user.'/crm-xml-feed.xml'));
        return view('edit', [
            'account' => $account,
            'url' => $url
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CompanyName  $companyName
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompanyName $account)
    {
        $name = $request['name'];
        $xml = $request['xml_feed'];
        $api = $request['key_cyan'];
        $account->update(array(
                   'name'=>$name,
                   'xml_feed'=>$xml,
                   'key_cyan'=>$api
        ));

       return redirect()->route('accounts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompanyName  $companyName
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanyName $account)
    {
        $account->delete();
        $feed_id = $account->id;
        CurrentXml::where('id_company', '=', $feed_id)
            ->where('id_user', Auth::user()->id)
            ->delete();
        return redirect()->route('accounts.index');
    }
    public function updateCurrentXmlBD(){
        date_default_timezone_set("Europe/Moscow");
        $collection_firms = CompanyName::select('id','xml_feed','user_id')->get();
        $array_xml = [];
        $array_new = [];
        $array_xml_feed = [];
        foreach($collection_firms as $value){
            $array_xml[$value['user_id']][$value['id']] =  $value['xml_feed'];
        }
        foreach($array_xml as $index_user =>$item_xml){
            foreach($item_xml as $index_company =>$current_item_xml){
                $xml_feed= CurrentXml::select('id_flat','bet','id_user','id_company','name_agent','top')
                                    ->where('id_user', $index_user)
                                    ->where('id_company', $index_company)
                                    ->get()->toArray();
                $xml = simplexml_load_file($current_item_xml);
                $array = json_decode(json_encode($xml),TRUE);
                foreach($xml_feed as $index_xml => $current_item_feed){
                    $array_xml_feed[$current_item_feed['id_flat']]['id_company']= $current_item_feed['id_company'];
                    $array_xml_feed[$current_item_feed['id_flat']]['id_flat']= $current_item_feed['id_flat'];
                    $array_xml_feed[$current_item_feed['id_flat']]['bet']= $current_item_feed['bet'];
                    $array_xml_feed[$current_item_feed['id_flat']]['id_user']= $current_item_feed['id_user'];
                    $array_xml_feed[$current_item_feed['id_flat']]['name_agent']= $current_item_feed['name_agent'];
                    $array_xml_feed[$current_item_feed['id_flat']]['top']= $current_item_feed['top'];
                }
                $array_xml_feed_copy = $array_xml_feed;
                foreach($array['object'] as $item => $current_item) {
                    $current_array['id_flat'] = (int)$current_item['ExternalId'];
                    $current_array['id_company'] = $index_company;
                    if(array_key_exists('Bet', $current_item)){
                        $current_bet = $current_item['Bet'];
                    }else{
                        $current_bet = null;
                    }
                    $current_agent_name = $current_item['SubAgent']['FirstName'].' '.$current_item['SubAgent']['LastName'];
                    if(array_key_exists('PublishTerms', $current_item)){
                        $current_top = '';
                        $current_another_top = '';
                        if(array_key_exists('Services', $current_item['PublishTerms']['Terms']['PublishTermSchema'])){
                            $current_top = $current_item['PublishTerms']['Terms']['PublishTermSchema']['Services']['ServicesEnum'];
                        }
                        if(array_key_exists('ExcludedServices', $current_item['PublishTerms']['Terms']['PublishTermSchema'])){
                            $current_another_top = $current_item['PublishTerms']['Terms']['PublishTermSchema']['ExcludedServices']['ExcludedServicesEnum'];
                        }
                        if($current_top == "top3" or $current_another_top == "top3"){
                            $top = 1;
                        }else{
                            $top = 0;
                        }
                    }else{
                        $top = 0;
                    }
                    if(array_key_exists($current_array['id_flat'], $array_xml_feed)){
                        CurrentXml::where('id_flat', '=', $current_array['id_flat'])
                            ->where('id_company', '=', $current_array['id_company'])
                            ->where('id_user', $index_user)
                            ->update(array(
                                'bet' => $current_bet,
                                'name_agent' =>$current_agent_name,
                                'top' => $top
                            ));
                        unset($array_xml_feed[$current_array['id_flat']]);
                    }
                    else{
                        $newObject = CurrentXml::create(array(
                            'id_flat' =>$current_array['id_flat'],
                            'bet'=> $current_bet,
                            'id_user'=> $index_user,
                            'id_company'=> $current_array['id_company'],
                            'name_agent'=>$current_agent_name,
                            'top' => $top
                        ));
                        $newObject->save();
                    } 
                }
            foreach($array_xml_feed as $current_array_xml_feed_index => $current_array_xml_feed){
                CurrentXml::where('id_flat', $current_array_xml_feed_index)
                            ->where('id_user', $index_user)
                            ->where('id_company', $current_array_xml_feed['id_company'])
                            ->delete();
                Bets::where('id_flat', $current_array_xml_feed_index)
                            ->where('id_user', $index_user)
                            ->where('id_company', $current_array_xml_feed['id_company'])
                            ->delete();
                }    
            }
        }
    }
}
