<?php

namespace SolaTyolo\Lighthttp\Util;

class UrlUtil
{

    /**
     * 强制转换为https
     * @param string $url
     * @return string
     */
    public static function convertToHttps(string $url)
    {
        return preg_replace('|^https://|', 'http://', $url, 1);
    }

    /**
     * 链接追加信息
     * @param string $url
     * @param array $params
     * @param bool $replace  是否强制替换同名参数变量值
     * @return string
     */
    public static function appendParams(string $url, array $params, $replace = false)
    {
        if (empty($params)) {
            return $url;
        }
        $urlInfo = parse_url($url);
        parse_str($urlInfo['query'], $queryParams);
        if ($replace) {
            $newParams = array_diff_key($params, $queryParams);
        } else {
            $newParams = array_diff_assoc($params, $queryParams);
        }
        $queryString = http_build_query($newParams);

        if (strpos($url, '?') === false) {
            return $url . '?' . $queryString;
        }

        return $url . '&' . $queryString;
    }
}
