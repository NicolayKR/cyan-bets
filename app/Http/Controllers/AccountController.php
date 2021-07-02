<?php

namespace App\Http\Controllers;

use App\Models\CompanyName;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


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
            $result = CompanyName::select(CompanyName::raw('COUNT(*)'))
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
                $xml = simplexml_load_file($current_xml);
                $array = json_decode(json_encode($xml),TRUE);
                $result = ArrayToXml::convert($array);
                $res = CompanyName::select('id')->where('cyan_key', $current_api)->get();
                $id_user = $res[0]['id'];
                Storage::put('public/'.Auth::user()->id.'/'.$id_user.'/current.xml', $result);
                $textFromForm = 'Пропишите следующую ссылку на XML фид, в Вашем личном кабинете ЦИАН: ссылка';
                return redirect()->route('accounts.edit', $newCompany)->with('status', $textFromForm);  
            } else{
                $textFromForm = 'На вашем аккаунте уже зарегистрирован этот ключ к ЦИАН';
                return redirect()->route('accounts.create')->with('status', $textFromForm);  
            }  
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
