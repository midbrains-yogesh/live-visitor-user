<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class DeactiveCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deactive:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'cron for deleted';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        date_default_timezone_set("Asia/Calcutta");
        $till_time = date("Y-m-d H:i:s", strtotime("-5 minutes"));
        DB::table('manages')->where('updated_at','<',$till_time)->delete();
        return "Cleared";
    }
}
