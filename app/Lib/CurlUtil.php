<?php
/**
 * 远程请求工具类
 * Created by PhpStorm.
 * User: liuguixin
 * Date: 2016/4/7
 * Time: 14:40
 */

namespace App\Lib;

class CurlUtil
{
    /**
     * 产生一个POST的http请求
     * @param $url 请求的url
     * @param array $data 请求参数数组
     * @return array
     */
    public static function postRequest($url,$data) {
        $result = array ();
        if (!$url || !$data) {
            return $result;
        }
        $process = curl_init();
        curl_setopt($process, CURLOPT_URL, $url);
        curl_setopt($process, CURLOPT_TIMEOUT, 20);
        curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($process, CURLOPT_HEADER, 0);
        curl_setopt($process, CURLOPT_POST, 1);
        curl_setopt($process, CURLOPT_POSTFIELDS, http_build_query($data));
        $response = curl_exec($process);
//        $http_code = curl_getinfo($process, CURLINFO_HTTP_CODE);
        curl_close($process);
        return $response;
    }
}