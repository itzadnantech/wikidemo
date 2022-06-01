<?php
defined('BASEPATH') or exit('No direct script access allowed');

/////Helper Function For Login Views//////
if (!function_exists('getLoginToken')) {
    function getLoginToken()
    {
        $params1 = [
            "action" => "query",
            "meta" => "tokens",
            "type" => "login",
            "format" => "json"
        ];
        $url = END_POINT . "?" . http_build_query($params1);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_COOKIEJAR, "cookie.txt");
        curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");

        $output = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($output, true);
        return $result["query"]["tokens"]["logintoken"];
    }
}
