<?php

namespace App\Interfaces;

interface CurlConnecttionInterface {
    public function curl_set_post($curl_option, $url, $param, $method, $token);

    public function curl_set_get($curl_option, $url, $token);

    public function curl_get($curl);
}
