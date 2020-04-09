<?php
//app/Helpers/Envato/User.php
namespace App\Helpers;
 
use Illuminate\Support\Facades\DB;
use Log;
 

class Utility
{

    public $useragent = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36";
    public $logger;
    public $cookie_path = '';

    // function __construct()
    // {
    //     $this->cookie_path = getcwd() . '/cookie.txt';
    //     $this->logger = new Logger();
    // }

    // static function getEnv()
    // {
    //     $hostname = php_uname("n");

    //     //$env = "";

    //     if (strpos($hostname, "local")) {
    //         $env = "DEV";
    //     } elseif (strpos($hostname, "ip-") !== false || strpos($hostname, "-test") !== false) {
    //         $env = "PRD";
    //     } else {
    //         $env = "DEV";
    //     }

    //     return $env;
    // }

    public static function notifySlack($message =  null)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://hooks.slack.com/');
        // curl_setopt($ch, CURLOPT_URL, 'https://hooks.slack.com/services/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');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"text\":\"$message\"}");

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

    }

    public static function getHtml($url, $num = 0)
    {
        $useragent = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36";

        $url = str_replace("&amp;", "&", $url);

        Log::logInfo($url);

        $file_name = app_path().'/Debug/html/' . md5($url) . '.html';

        if (env('SAVE_HTML')) {
            if (!file_exists(app_path().'/Debug/html')) {
                mkdir(app_path().'/Debug/html', 0777, true);
            }
            if (file_exists($file_name)) {
                return file_get_contents($file_name);
            }
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 3);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        // curl_setopt($ch, CURLOPT_USERAGENT, $this->useragent);
        curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        // if (file_exists($this->cookie_path)) {
        //     curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookie_path);
        // }

        $contents = curl_exec($ch);
        curl_close($ch);

        // if (empty($contents) && $num < 1) {
        //     sleep(3);
        //     // $this->logger->warn($url);
        //     $num++;
        //     $contents = $this->getHtml($url, $num);
        // }

        if (env('SAVE_HTML')) {
            file_put_contents($file_name, $contents);
        }

        return $contents;
    }

    public static function decodeString($string = null){
        $string =  trim($string);
        $string =  utf8_decode($string);
        $string = str_replace(array(
            '*','+'
        ), '',$string);
        return $string;
    }
}