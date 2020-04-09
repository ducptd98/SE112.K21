<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;


use App\Jobs\Category;
use App\Jobs\getProductUrl;
use App\Helpers\Utility;

// use App\Models\Start_Model;
use DB;
use App\Model\Category_Model;
use App\Model\Product_Model;

class index extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:index';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get category site';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        Utility::notifySlack("Start get: ".env("SITE_NAME"));
        Category_Model::truncateCategory();

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // $start_url  =  Start_Model::getStartUrl();
        
        $start_urls  =  DB::table('tbl_startUrl')->get();
        foreach ($start_urls as $item) {
            Category::dispatch($item);
        }
        Product_Model::truncateProduct();
        $category_urls  =  DB::table('tbl_Category')->where('status','TODO')->get();
        foreach ($category_urls as $item) {
            Category_Model::setCategoryStatus(['id'=> $item->id],['status'=>'DOING']);
            getProductUrl::dispatch($item);
        }

        return;
    }
}
