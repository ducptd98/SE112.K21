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

    public static function notifySlack($message =  null)
    {
        $ch = curl_init();

        // curl_setopt($ch, CURLOPT_URL, 'https://hooks.slack.com/');
        curl_setopt($ch, CURLOPT_URL, 'https://hooks.slack.com/services/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');
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
        curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        // if (file_exists($this->cookie_path)) {
        //     curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookie_path);
        // }

        $contents = curl_exec($ch);
        curl_close($ch);

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


    public static function replaceString($string)
    {
        $unwanted_array = array('”' => '"', 'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E',
            'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ù' => 'U',
            'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Þ' => 'B', 'ß' => 'Ss', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c',
            'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o',
            'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ý' => 'y', 'þ' => 'b', 'ÿ' => 'y', '�' => '', '”' => '"');
        $string = trim(strtr($string, $unwanted_array));

        $string = iconv('UTF-8', 'ISO-8859-1//TRANSLIT//IGNORE', $string);

        $string = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $string);
        $string = preg_replace('!\s+!', ' ', $string);

        $string = str_replace("?????", '', $string);
        $string = ltrim($string, '-');
        $string = trim($string);
        return $string;
    }
}