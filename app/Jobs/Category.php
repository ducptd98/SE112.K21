<?php

namespace App\Jobs;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

use App\Helpers\Utility;
use App\Model\Category_Model;
use phpQuery;

class Category implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $start;

    public function __construct($start)
    {
        $this->start = $start;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $html = Utility::getHtml($this->start->url);
        

        $doc = phpQuery::newDocumentHTML($html, 'UTF-8');
        $mainMenu = $doc['ul.dropdown-navigative-menu>li.lv0'];
        if (sizeof($mainMenu)) {
            Log::debug("<--- Start get Category 1 ---->");

            $status = 'TODO';
            foreach ($mainMenu as $li) {
                $category = Utility::decodeString(pq($li)->find('a:first')->text());
                $url = pq($li)->find('a:first')->attr('href');
                if ($url && strpos($url, env('SITE_DOMAIN')) === false) {
                    $url = env('SITE_DOMAIN') . $url;
                }
                $data = [
                    "category1" => str_replace('%', '', $category),
                    "url" => $url,
                    "url_encode" => md5($url),
                    "status" => $status,
                ];
                $ignore = array(
                    'Men',
                    'Women',
                );
                if (!in_array($category, $ignore)) {
                    // $data['ignore_code'] = getIgnoreCode($data);
                    $data['id'] = Category_Model::createCategory($data);
                    $this->getCate2($data, $li);
                }
            }
        }
        phpQuery::unloadDocuments();

    }
    public function getCate2($data, $doc)
    {
        $categories = pq($doc)->find('ul>li.lv1');
        if (sizeof($categories)) {
            Log::debug("<--- Start get Category 2 ---->");

            foreach ($categories as $li) {
                $data2 = $data;
                if (isset($data2['id'])) {
                    unset($data2['id']);
                }
                $category = Utility::decodeString(pq($li)->find('a:first')->text());
                $url = pq($li)->find('a:first')->attr('href');
                if ($url && strpos($url, env('SITE_DOMAIN')) === false) {
                    $url = env('SITE_DOMAIN') . $url;
                }
                $data2['category2'] = $category;
                $data2['url'] = $url;
                $data2['url_encode'] = md5($url);
                $ignore = array(
                    'Designers',
                    'New In',
                    "Black Friday Men's Designer Sale",
                    "Black Friday Designer Sale",

                );
                if (!in_array($category, $ignore)) {
                    // $data2['ignore_code'] = getIgnoreCode($data2);
                    $data2['id'] = Category_Model::createCategory($data2);
                    $this->getCate3($data2, $li);
                }

            }
            Category_Model::setCategoryStatus(["id" => $data['id']], ['status' => 'IGNORE']);
        }
    }
    public function getCate3($data, $doc)
    {
        $categories = pq($doc)->find('ul>li.lv2');
        if (sizeof($categories)) {
            Log::debug("<--- Start get Category 3 ---->");

            foreach ($categories as $li) {
                $data2 = $data;
                if (isset($data2['id'])) {
                    unset($data2['id']);
                }
                $category = Utility::decodeString(pq($li)->find('a:first')->text());
                $url = pq($li)->find('a:first')->attr('href');
                if ($url && strpos($url, env('SITE_DOMAIN')) === false) {
                    $url = env('SITE_DOMAIN') . $url;
                }
                $data2['category3'] = $category;
                $data2['url'] = $url;
                $data2['url_encode'] = md5($url);
                $ignore = array(
                    'Designers',
                    'New In',
                    "Black Friday Men's Designer Sale",
                    "Black Friday Designer Sale",

                );
                if (!in_array($category, $ignore)) {
                    // $data2['ignore_code'] = getIgnoreCode($data2);
                    Category_Model::createCategory($data2);
                }

            }
            Category_Model::setCategoryStatus(["id" => $data['id']], ['status' => 'IGNORE']);
        }
    }
}
