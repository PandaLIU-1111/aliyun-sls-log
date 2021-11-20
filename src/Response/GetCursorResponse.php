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

/**
 * The response of the GetCursor API from log service.
 */
class GetCursorResponse extends Response
{
    /**
     * @var string cursor
     */
    private $cursor;

    /**
     * GetCursorResponse constructor.
     *
     * @param array $resp
     *                    GetLogs HTTP response body
     * @param array $header
     *                      GetLogs HTTP response header
     */
    public function __construct($resp, $header)
    {
        parent::__construct($header);
        $this->cursor = $resp['cursor'];
    }

    /**
     * Get cursor from the response.
     *
     * @return string cursor
     */
    public function getCursor()
    {
        return $this->cursor;
    }
}
