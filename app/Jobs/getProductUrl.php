<?php

namespace App\Jobs;

use App\Helpers\Utility;
use App\Model\Category_Model;
use App\Model\Product_Model;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use phpQuery;
use Log;

class getProductUrl implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $category;

    public function __construct($category)
    {
        $this->category = $category;
    }

    /**
     * Execute the job.
     *
     * @return void
     */

    public function handle()
    {
        // $category->url = "https://www.brownsfashion.com/jp/shopping/man/suits-formal-suits";
        $html = Utility::getHtml($this->category->url);
        $doc = phpQuery::newDocument($html);
        $text = $doc['div.product-list div.Title div.Footer span:eq(1) strong']->text();
        if (empty($text)) {
            $text = $doc['div#modal-controller-container main section:eq(1) div:first span:first']->text();
        }
        $text = str_replace(array(' ', ',', '.'), '', $text);
        $total_item = (int) $text;
        phpQuery::unloadDocuments();
        $total_page = ceil($total_item / env('ITEM_PAGE'));

        $this->parseUrl($this->category, $html, true);
        for ($i = 2; $i <= $total_page; $i++) {
            $html = Utility::getHtml($this->category->url . '/p' . $i);
            $this->parseUrl($this->category, $html);
        }
    }

    public function parseUrl($category, $html, $update = false)
    {
        $status = 'ERROR';
        $doc = phpQuery::newDocument($html);
        $productUrls = $doc['div.search-productItem div.p-title'];
        if (sizeof($productUrls)) {
            foreach ($productUrls as $productUrl) {
                $url = pq($productUrl)->find('a:first')->attr('href');
                if ($url && strpos($url, env('SITE_DOMAIN')) === false) {
                    $url = env('SITE_DOMAIN') . $url;
                }
                $data = array(
                    'category1' => $category->category1,
                    'category2' => $category->category2,
                    'category3' => $category->category3,
                    'url' => $url,
                    'url_encode' => md5($url),
                    'status' => 'TODO',
                );
                try
                {
                    Product_Model::createProduct($data);
                } catch (\Illuminate\Database\QueryException $e) {
                    // Log::logError($e);
                }
            }
            $status = 'DONE';
        }

        if ($update) {
            Category_Model::setCategoryStatus(["id" => $category->id], ['status' => $status]);
        }
        phpQuery::unloadDocuments();
    }
}
