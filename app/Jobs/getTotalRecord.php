<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Model\ProductDetail_Model;
use App\Helpers\Utility;

class getTotalRecord implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $path  = "/Record/total_record.txt";

    public function __construct()
    {
        
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //get and set total record to file
        $file_name  = app_path().$this->path;
        $old_record = file_get_contents($file_name);
        $new_record = ProductDetail_Model::countDetail();
        file_put_contents($file_name,$new_record);

        // notify to slack
        $message = "TOTAL RECORD TODAY: ".$new_record;;
        $percent = 0 ;
        if ($old_record != 0) {
            $percent =  ceil($new_record/$old_record) *100;
        }
        
        if ($percent > 10 && $percent < 100) {
            $message =  "WARNING: Lower ".$percent."%";
            $message .=  "\n\t ->TOTAL RECORD TODAY: ".$new_record;
            $message .= "\n\t ->TOTAL RECORD YESTERDAY: ".$old_record;

        }
        if ($percent > 110) {
            $message =  "WARNING: Higher ".$percent."%";
            $message .=  "\n\t ->TOTAL RECORD TODAY: ".$new_record;
            $message .= "\n\t ->TOTAL RECORD YESTERDAY: ".$old_record;

        }
        Utility::notifySlack($message);
    }
}
