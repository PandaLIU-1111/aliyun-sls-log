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
 * The response of the UpdateLogstore API from log service.
 */
class UpdateLogstoreResponse extends Response
{
    /**
     * UpdateLogstoreResponse constructor.
     *
     * @param array $resp
     *                    UpdateLogstore HTTP response body
     * @param array $header
     *                      UpdateLogstore HTTP response header
     */
    public function __construct($resp, $header)
    {
        parent::__construct($header);
    }
}
