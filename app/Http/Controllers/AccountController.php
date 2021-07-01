<?php

namespace App\Http\Controllers;

use App\Models\CompanyName;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
            'accounts' => CompanyName::paginate(10)]);
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
        if($result['result']['totalBalance']){
            $status_api_connect = true;
        };
           //FILEGETCONTENT
        if(file_get_contents($current_xml)){
            $status_xml_connect = true;
        };
        if($status_xml_connect and $status_api_connect){
            $result = CompanyName::select(CompanyName::raw('COUNT(*)'))
                                            ->where('name', $request->input('company_name'))
                                            ->where('xml_feed', $current_xml)
                                            ->where('cyan_key', $current_api)
                                            ->count();         
            if($result==0){
                $newCompany= CompanyName::create(array(
                    'name' => $request->input('company_name'),
                    'xml_feed' =>$current_xml,
                    'cyan_key' =>$current_api,
                    'user_id'=> Auth::user()->id 
                ));
                $newCompany->save();
                $textFromForm = 'Пропишите следующую ссылку на XML фид, в Вашем личном кабинете ЦИАН: ';
            }   
            return redirect()->route('accounts.index')->with('status', $textFromForm);  
        };
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
        return view('edit', [
            'account' => $account,
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
        return redirect()->route('accounts.index');
    }
}
