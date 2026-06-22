<?php

namespace App\services;
use SoapClient;
use Exception;

class SmsService
{
    public $code;
    public $mobile;
    public static function send($code, $mobile)
    {
        ini_set("soap.wsdl_cache_enabled", "0");
        $sms_client = new SoapClient('http://api.payamak-panel.com/post/send.asmx?wsdl', array('encoding' => 'UTF-8'));

        $parameters['username'] = "9901209463";
        $parameters['password'] = "d72abfd2-ba2f-4cb2-b4a8-29578c2d4875";
        $parameters['to'] = "$mobile";
        // $parameters['from'] = "50004001464354";
        $parameters['text'] = ["$code"];
        $parameters['bodyId'] = 478949;
        $parameters['isflash'] = true;
        $response = $sms_client->SendByBaseNumber($parameters)->SendByBaseNumberResult;

        if (is_numeric($response) && strlen((string) $response) >= 15) {
            return true;
        } else {
            throw new Exception('مشکل در ارسال کد تایید لطفا کمی بعد تلاش کنید یا لطفا با پشتیبانی تماس بگیرید');
        }
    }
}
