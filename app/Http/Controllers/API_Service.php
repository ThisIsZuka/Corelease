<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use Session;

use Illuminate\Support\Facades\Http;

class API_Service extends BaseController
{
    public function Send_SMS()
    {
        try {
            $dataNum = ['04512', '012', '1515'];
            $response = Http::get('http://ufund-portal.webhop.biz:9090/API-Corelease/api/master_prefix', [
                'name' => 'Taylor,456',
                'page' => '',
            ]);
            dd($response);
            // return $response;
        } catch (Exception $e) {
            return response()->json(array(
                'status' => 'Error',
                'message' => $e->getMessage()
            ));
        }
    }

    public function PostRequest($url, $referer, $_data)
    {
        // convert variables array to string:
        $data = array();
        while (list($n, $v) = each($_data)) {
            $data[] = "$n=$v";
        }
        $data = implode('&', $data);
        // format --> test1=a&test2=b etc.
        // parse the given URL
        $url = parse_url($url);
        if ($url['scheme'] != 'http') {
            die('Only HTTP request are supported !');
        }
        // extract host and path:
        $host = $url['host'];
        $path = $url['path'];
        // open a socket connection on port 80
        $fp = fsockopen($host, 80);
        // send the request headers:
        fputs($fp, "POST $path HTTP/1.1\r\n");
        fputs($fp, "Host: $host\r\n");
        fputs($fp, "Referer: $referer\r\n");
        fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
        fputs($fp, "Content-length: " . strlen($data) . "\r\n");
        fputs($fp, "Connection: close\r\n\r\n");
        fputs($fp, $data);
        $result = '';
        while (!feof($fp)) {
            // receive the results of the request
            $result .= fgets($fp, 128);
        }
        // close the socket connection:
        fclose($fp);
        // split the result header from the content
        $result = explode("\r\n\r\n", $result, 2);
        $header = isset($result[0]) ? $result[0] : '';
        $content = isset($result[1]) ? $result[1] : '';
        // return as array:
        return array($header, $content);
    }

    public function submit_send_SMS()
    {
        $data = array(
            'user' => "user",
            'password' => "password",
            'msisdn' => "66894828550",
            'sid' => "WebSMS",
            'msg' => "Test Message from MailBIT",
            'fl' => "0",
        );
        dd($data);
        list($header, $content) = $this->PostRequest("http://sms.mailbit.co.th:8080/vendorsms/pushsms.aspx?user=abc&password=xyz&msisdn=6689xxxxxx&sid=SenderId&msg=test%20message&fl=0&gwid=2",'www.ufund.com' ,$data);
        echo $content;
    }
}
