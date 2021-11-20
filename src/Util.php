<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace Hyperf\AliyunSlsLog;

class Util
{
    public static function getLocalIp(): string
    {
        $localIp = gethostbyname(php_uname('n'));
        if (strlen($localIp) == 0) {
            $localIp = gethostbyname(gethostname());
        }
        return $localIp;
    }

    public static function calMD5($value): string
    {
        return strtoupper(md5($value));
    }

    /**
     * Get request authorization string as defined.
     *
     * @param mixed $method
     * @param mixed $resource
     * @param mixed $key
     * @param mixed $stsToken
     * @param mixed $params
     * @param mixed $headers
     * @return string
     */
    public static function getRequestAuthorization($method, $resource, $key, $stsToken, $params, $headers)
    {
        if (! $key) {
            return '';
        }
        $content = $method . "\n";
        if (isset($headers['Content-MD5'])) {
            $content .= $headers['Content-MD5'];
        }
        $content .= "\n";
        if (isset($headers['Content-Type'])) {
            $content .= $headers['Content-Type'];
        }
        $content .= "\n";
        $content .= $headers['Date'] . "\n";
        $content .= Util::canonicalizedLOGHeaders($headers) . "\n";
        $content .= Util::canonicalizedResource($resource, $params);
        return Util::hmacSHA1($content, $key);
    }

    /**
     * Get canonicalizedLOGHeaders string as defined.
     *
     * @param mixed $header
     * @return string
     */
    public static function canonicalizedLOGHeaders($header)
    {
        ksort($header);
        $content = '';
        $first = true;
        foreach ($header as $key => $value) {
            if (strpos($key, 'x-log-') === 0 || strpos($key, 'x-acs-') === 0) { // x-log- header
                if ($first) {
                    $content .= $key . ':' . $value;
                    $first = false;
                } else {
                    $content .= "\n" . $key . ':' . $value;
                }
            }
        }
        return $content;
    }

    /**
     * Get canonicalizedResource string as defined.
     *
     * @param mixed $resource
     * @param mixed $params
     */
    public static function canonicalizedResource($resource, $params): string
    {
        if ($params) {
            ksort($params);
            $urlString = '';
            $first = true;
            foreach ($params as $key => $value) {
                if ($first) {
                    $first = false;
                    $urlString = "{$key}={$value}";
                } else {
                    $urlString .= "&{$key}={$value}";
                }
            }
            return $resource . '?' . $urlString;
        }
        return $resource;
    }

    /**
     * Calculate string $content hmacSHA1 with secret key $key.
     *
     * @param mixed $content
     * @param mixed $key
     */
    public static function hmacSHA1($content, $key): string
    {
        $signature = hash_hmac('sha1', $content, $key, true);
        return base64_encode($signature);
    }

    /**
     * Change $logGroup to bytes.
     *
     * @param mixed $logGroup
     * @return string
     */
    public static function toBytes($logGroup)
    {
        $mem = fopen('php://memory', 'rwb');
        $logGroup->write($mem);
        rewind($mem);
        $bytes = '';

        if (feof($mem) === false) {
            $bytes = fread($mem, 10 * 1024 * 1024);
        }
        fclose($mem);

        return $bytes;
        //$mem = fopen("php://memory", "wb");
        /*   $fiveMBs = 5*1024*1024;
           $mem = fopen("php://temp/maxmemory:$fiveMBs", 'rwb');
           $logGroup->write($mem);
          // rewind($mem);

          // fclose($mem);
           //d://logGroup.pdoc
          // $mem = fopen("php://memory", "rb");
          // $mem = fopen("php://temp/maxmemory:$fiveMBs", 'r+');
           $bytes;
           while(!feof($mem))
               $bytes = fread($mem, 10*1024*1024);
           fclose($mem);
           //test
           if($bytes===false)echo "fread fail";
           return $bytes;*/
    }

    /**
     * Get url encode.
     *
     * @param mixed $value
     */
    public static function urlEncodeValue($value): string
    {
        return urlencode((string) $value);
    }

    /**
     * Get url encode.
     *
     * @param mixed $params
     */
    public static function urlEncode($params): string
    {
        ksort($params);
        $url = '';
        $first = true;
        foreach ($params as $key => $value) {
            $val = Util::urlEncodeValue($value);
            if ($first) {
                $first = false;
                $url = "{$key}={$val}";
            } else {
                $url .= "&{$key}={$val}";
            }
        }
        return $url;
    }

    /**
     * If $gonten is raw IP address, return true.
     *
     * @param mixed $gonten
     * @return bool
     */
    public static function isIp($gonten)
    {
        $ip = explode('.', $gonten);
        for ($i = 0; $i < count($ip); ++$i) {
            if ($ip[$i] > 255) {
                return 0;
            }
        }
        return preg_match('/^[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}$/', $gonten);
    }
}
