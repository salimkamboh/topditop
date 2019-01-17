<?php

namespace App\Http;

use Illuminate\Support\Facades\Request;
use ReCaptcha\ReCaptcha;


trait CaptchaTrait
{
    public function captchaCheck()
    {
        $response = Request::get('g-recaptcha-response');
        $remoteip = $_SERVER['REMOTE_ADDR'];
        $secret   = env('RE_CAP_SECRET');

        $recaptcha = new ReCaptcha($secret);
        $resp = $recaptcha->verify($response, $remoteip);

        if ($resp->isSuccess()) {
            return true;
        }
        return false;
    }
}