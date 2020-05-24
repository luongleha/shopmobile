<?php

namespace App\Repositories;

use App\Interfaces\CurlConnecttionInterface;

class CurlConnectionRepository implements CurlConnecttionInterface {

    public function curl_set_post($curl_option, $url, $param, $method, $token = null) {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => $curl_option,
            CURLOPT_URL => $url,
            CURLOPT_POST => 1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/x-www-form-urlencoded',
                $token,
            ],
            CURLOPT_POSTFIELDS => http_build_query($param)
        ]);
        return $curl;
    }

    public function curl_set_get($curl_option, $url, $token = null) {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => $curl_option,
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/x-www-form-urlencoded',
                $token,
            ],
        ]);
        return $curl;
    }

    public function curl_get($curl) {
        $resp = curl_exec($curl);
        $res = json_decode($resp);
        curl_close($curl);
        return $res;
    }
}
