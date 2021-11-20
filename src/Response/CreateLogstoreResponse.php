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
 * The response of the CreateLogstore API from log service.
 */
class CreateLogstoreResponse extends Response
{
    /**
     * CreateLogstoreResponse constructor.
     *
     * @param array $resp
     *                    CreateLogstore HTTP response body
     * @param array $header
     *                      CreateLogstore HTTP response header
     */
    public function __construct($resp, $header)
    {
        parent::__construct($header);
    }
}
