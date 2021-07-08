<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TableController;
use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Auth;
use App\Models\CompanyName;
use App\Models\Bets;
use App\Models\CyanCallPhones;
use Spatie\ArrayToXml\ArrayToXml;
use Illuminate\Support\Facades\Storage;
use App\Models\CurrentXml;
use Gaarf\XmlToPhp\Convertor;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/','index')->middleware('auth')->name('index');
Route::view('add-form', 'add-form')->name('add-form');
Route::get('/getData','App\Http\Controllers\TableController@getData');
Route::get('/updateNow/{account}','App\Http\Controllers\XmlController@updateXml')->name('updateNow');
Route::post('/saveNewBet','App\Http\Controllers\TableController@saveNewBet');
Route::get('/getDataFromNewBet','App\Http\Controllers\TableController@getDataFromNewBet');
Route::get('getName', function(){
    return Auth::user()->name;
});
Route::resource('/accounts','App\Http\Controllers\AccountController');
Auth::routes();

Route::get('test',function(){
    $date = new DateTime('-2 days');
    $startTime =  $date->format('Y-m-d');
    $collection_keys = CompanyName::select('id','cyan_key','user_id')->get();
    foreach($collection_keys as $collection_key){
        $url = 'https://public-api.cian.ru/v1/get-calls-report?page=1&pageSize=100&dateFrom='.$startTime; //?startTime=2019-01-10
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Bearer ".$collection_key->cyan_key));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $curl_response = curl_exec($curl);
        $res = json_decode($curl_response);
        curl_close($curl);
        if ($res->result->calls) {
            $ar_calls = array_reverse($res->result->calls);
            foreach ($ar_calls as $call) {
                $phone = preg_replace('/\D+/', '', $call->sourcePhone);
                CyanCallPhones::create(array(
                    'phone'=>$phone,
                    'called'=>$call->date,
                    'id_user'=>$collection_key->user_id,
                    'id_company'=>$collection_key->id
                    ));
                }
            }
        }
 });
Route::get('test1',function(){

    CompanyName::where('created_at','<','DATE_SUB(NOW(), INTERVAL 5 DAY)')->delete();
    $limit = 80;//file_get_contents(APP_PATH.'script/cian/cian_call_phones.limit');Было, но в файле 80 
    $sql = CompanyName::select('phone','DATE_FORMAT(called, "%Y-%m-%d") as called_date')
                        ->orderBy('id')
    $sql = 'SELECT `phone`, DATE_FORMAT(`called`, "%Y-%m-%d") as called_date FROM `cian_call_phones` ORDER BY `id` LIMIT '.$limit.', 10';
    $phones = Base::GetObjectByQuery($sql);

    if (count($phones)<10) {
        $limit = 0;
    } else {
        $limit += 10;
    }
    file_put_contents(APP_PATH.'script/cian/cian_call_phones.limit', $limit);

    foreach ($phones as $ph) {
        $phone = $ph['phone'];
        $receive_path = 70;

        $phone = Functions::clear_phone_crm($phone);

        if (!empty($phone) && $phone != '' && strlen($phone)==11) {
            
            $sql = 'SELECT `idx` FROM  `clients_flats` '
                    . 'WHERE '
                    . '(`num1` LIKE "'.$phone.'" OR '
                    . ' `num2` LIKE "'.$phone.'" OR '
                    . ' `num3` LIKE "'.$phone.'" OR '
                    . ' `num4` LIKE "'.$phone.'" OR '
                    . ' `num5` LIKE "'.$phone.'" OR '
                    . ' `num6` LIKE "'.$phone.'") AND ( (`returned` IS NOT NULL AND `returned` > DATE_SUB(NOW(), INTERVAL 7 DAY) OR `created` > DATE_SUB(NOW(), INTERVAL 7 DAY) AND (`receive_path` = 58 OR `receive_path` = 12) ) AND (`receive_path_last_date` IS NULL OR "'.$ph['called_date'].'" <= DATE_FORMAT(`receive_path_last_date`, "%Y-%m-%d"))  )';
            $rows = Base::GetObjectByQuery($sql);
            //AND `receive_path` != '.$receive_path.'
            //AND ( (`removed` IS NULL AND `receive_path` = 58 OR `removed` IS NOT NULL AND `removed` < DATE_SUB(NOW(), INTERVAL 30 DAY) ) AND (`receive_path_last_date` IS NULL OR "'.$ph['called_date'].'" < DATE_FORMAT(`receive_path_last_date`, "%Y-%m-%d"))  )

            if ($rows) {
                foreach ($rows as $row) {
                    $sql = 'UPDATE `clients_flats` SET `creator` = 0, `adv_id` = '.$receive_path.', `receive_path` = '.$receive_path.', `receive_path_last_date` = "'.$ph['called_date'].'" WHERE `idx` = '.$row['idx'].' LIMIT 1';
                    $res = mysql_query($sql);
                }
            }
            
        }
    }
});