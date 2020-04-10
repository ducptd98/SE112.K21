<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;


use App\Jobs\getCategory;
use App\Jobs\getTotalRecord;
use App\Jobs\getProductUrl;
use App\Jobs\getDetail;
use App\Helpers\Utility;

// use App\Models\Start_Model;
use DB;
use Log;
use App\Model\Start_Model;
use App\Model\Category_Model;
use App\Model\Product_Model;
use App\Model\ProductDetail_Model;

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
    protected $description = '<--- START PROCESS --->';

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
     * @return mixed
     */
    public function handle()
    {
        Utility::notifySlack($this->description);
        // Utility::notifySlack("Start get: ".env("SITE_NAME"));
        Log::logInfo($this->description);
        //truncate all data on DB
        $this->truncateData();

        //get Category
        $this->getCategory();

        //get Product Url
        $this->getProductUrl();

        //Parse Detail
        $this->getProductDetail();

        //Count Record
        getTotalRecord::dispatch();

        return;
    }

    function truncateData()
    {
        Category_Model::truncateCategory();
        Product_Model::truncateProduct();
        ProductDetail_Model::truncateDetail();
    }

    function getCategory()
    {
        Log::logInfo("<--- Start get Category --->");
        $start_urls  =  Start_Model::getStartUrl();
        foreach ($start_urls as $item) {
            getCategory::dispatch($item);
        }
    }
    function getProductUrl()
    {
        Log::logInfo("<--- Start get Product Url --->");
        $category_urls  =  Category_Model::getCategory(['status'=>'TODO']);
        foreach ($category_urls as $item) {
            Category_Model::setCategoryStatus(['id'=> $item->id],['status'=>'DOING']);
            getProductUrl::dispatch($item);
        }
    }
    function getProductDetail()
    {
        Log::logInfo("<--- Start get Parse Detail --->");
        $record =  0;
        do {
            $product_urls  =  Product_Model::getProductLimit(10);
            $ids = array_column((array)$product_urls, 'id');
            Product_Model::setProductStatus($ids,['status'=>'DOING']);
            foreach ($product_urls as $item) {
                getDetail::dispatch((object)$item);
            }
            $record =  Product_Model::coutProduct(['status'=>'TODO']);
        } while ($record > 0);
    }
}
