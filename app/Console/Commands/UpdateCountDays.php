<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class UpdateCountDays extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:countDays';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update count left day';

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
        date_default_timezone_set("Europe/Moscow");
        $d = Auth::user()->paid_month;
        $left = Auth::user()->left_day;  
        $today  = date("y-m-d");
        $dateAt = strtotime('+'.$d.' MONTH', strtotime($today));
        $lastDay = date('Y-m-d', $dateAt);
        $d1_ts = strtotime($today);
        $d2_ts = strtotime($lastDay);
        $seconds = abs($d1_ts - $d2_ts);
        $days = floor($seconds / 86400);
        if($left == null){
            Auth::user()->update(array(
                'left_day'=>$days,
            ));
        }else{
            if($left!=0){
                Auth::user()->update(array(
                    'left_day'=>(int)$left-1,
                ));
            }
            else{
                Auth::user()->update(array(
                    'paid_month'=>0,
                    'left_day'=>NULL,
                ));
            }
        }
    }
}
