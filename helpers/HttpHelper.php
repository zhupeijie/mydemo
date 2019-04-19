<?php

namespace helpers;

class HttpHelper
{

    /**
     * 发起一个 curl 请求, 支持 GET/POST 请求
     *
     * @param $url
     * @param array $params
     * @param string $cookie
     * @param array $headers
     * @param int $isPost
     * @param bool $https
     * @return mixed
     */
    private function curlReq($url, $params = [], $cookie = "", array $headers = [], $isPost = 1, $https = false)
    {
        $ch = curl_init();

        if ($cookie) {
            curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
            curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
        }

        curl_setopt($ch, CURLOPT_HEADER, 0);

        if ($isPost) {
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            $reqBody = is_array($params) ? http_build_query($params) : $params;
            curl_setopt($ch, CURLOPT_POSTFIELDS, $reqBody);
        } else {
            if (!empty($params)) {
                curl_setopt($ch, CURLOPT_URL, $url . '?' . http_build_query($params));
            } else {
                curl_setopt($ch, CURLOPT_URL, $url);
            }
        }
        if (!empty($headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        if ($https) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // 对认证证书来源的检查
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); // 从证书中检查SSL加密算法是否存在
        }

        // 设置获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // 执行命令
        $data = curl_exec($ch);
        // 关闭URL请求
        curl_close($ch);

        return $data;
    }
}