<?php

namespace App\Jobs;

use App\Helpers\Utility;
use App\Model\ProductDetail_Model;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use phpQuery;
use App\Model\Product_Model;

class getDetail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $product;
    private $response;

    public function __construct($product)
    {
        $this->product = $product;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $html = Utility::getHtml($this->product->url);
        $doc = phpQuery::newDocumentHTML($html, 'utf-8');

        $status = 'ERROR';
        $data = array();
        $data['category_parent'] = $this->product->category_parent;
        $data['url'] = $this->product->url;
        if ($data['url'] && strpos($data['url'], env('SITE_DOMAIN')) !== false) {
            $data['url'] = str_replace(env('SITE_DOMAIN'), env('APP_URL'), $data['url']) ;
        }
        $data['category1'] = $this->product->category1;
        $data['category2'] = $this->product->category2;
        $data['category3'] = $this->product->category3;
        $this->getName($doc, $data);
        $this->getContact($doc, $data);
        $this->getPrice($doc, $data);
        $this->getArea($doc, $data);
        $this->getAddress($doc, $data);
        $this->getDescription($doc, $data);
        $this->getImages($doc, $data);
        if (!empty($data['name']) && !empty($data['price'])) {
            try
            {
                ProductDetail_Model::createDetail($data);
                $status = "DONE";
                
            } catch (\Illuminate\Database\QueryException $e) {
                // Log::logError($e);
                $status = "CAN NOT SAVE";
            }
        }
        phpQuery::unloadDocuments();
        Product_Model::setProductStatus(['id'=>$this->product->id],['status'=>$status]);
    }

    public function getName($doc, &$data)
    {
        $name = $doc['div#product-detail div.pm-title h1']->text();
        $data['name'] = trim(utf8_decode($name));
    }
    public function getContact($doc, &$data)
    {
        $contact = $doc['div.right.contact-phone:first']->text();
        $data['contact'] = trim($contact);
    }

    public function getAddress($doc, &$data)
    {
        $address = $doc['div#product-detail div.kqchitiet span.diadiem-title']->text();
        $data['address'] = trim(utf8_decode($address));
    }
    public function getPrice($doc, &$data)
    {
        $price = $doc['div#product-detail div.kqchitiet span.gia-title:eq(0) strong']->text();
        $price = Utility::replaceString(utf8_decode($price));
        $data['price'] = trim($price);
    }

    public function getArea($doc, &$data)
    {
        $area = $doc['div#product-detail div.kqchitiet span.gia-title:eq(1) strong']->text();
        $data['area'] = trim(utf8_decode($area));
    }

    public function getDescription($doc, &$data)
    {
        $desc = $doc['div#product-detail div.pm-content div.pm-desc']->html();
        $desc = utf8_decode($desc);
        $search = array(
            '</div>',
            '</p>',
            '</span>',
            '</li>',
            '<br>',
        );
        $replace = array(
            '</div>' . PHP_EOL,
            '</p>' . PHP_EOL,
            '</span>' . PHP_EOL,
            '<br>' . PHP_EOL,
        );
        $desc = str_replace("\n", '', $desc);
        $desc = preg_replace('/\s\s+/', ' ', $desc);
        $desc = strip_tags(str_replace($search, $replace, $desc));
        $desc = explode(PHP_EOL, $desc);
        $desc = json_encode($desc);
        $data['desc'] = $desc;
    }

    public function getImages($doc, &$data)
    {
        $images = $doc['#thumbs li img'];
        $list_images = array();
        if (sizeof($images)) {
            foreach ($images as $item) {
                $src = pq($item)->attr('src');
                $src = str_replace('200x200', '745x510', $src);
                $list_images[] = trim($src);
            }
        }
        $list_images = json_encode($list_images);
        $data['images'] = trim($list_images);
    }

    public function getResponse()
    {
        return $this->response;
    }
}
