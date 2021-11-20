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
namespace Hyperf\AliyunSlsLog\Response;

class Response
{
    /**
     * @var array HTTP response header
     */
    private $headers;

    /**
     * Response constructor.
     *
     * @param array $header
     *                      HTTP response header
     * @param mixed $headers
     */
    public function __construct($headers)
    {
        $this->headers = $headers;
    }

    /**
     * Get all http headers.
     *
     * @return array HTTP response header
     */
    public function getAllHeaders()
    {
        return $this->headers;
    }

    /**
     * Get specified http header.
     *
     * @param string $key
     *                    key to get header
     *
     * @return string HTTP response header. '' will be return if not set.
     */
    public function getHeader($key)
    {
        return $this->headers[$key] ?? '';
    }

    /**
     * Get the request id of the response. '' will be return if not set.
     *
     * @return string request id
     */
    public function getRequestId()
    {
        return $this->headers['x-log-requestid'] ?? '';
    }
}
