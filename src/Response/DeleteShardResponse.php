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
 * The response of the DeleteShard API from log service.
 */
class DeleteShardResponse extends Response
{
    /**
     * DeleteShardResponse constructor.
     *
     * @param array $header
     *                      DeleteShard HTTP response header
     * @param mixed $headers
     */
    public function __construct($headers)
    {
        parent::__construct($headers);
    }
}
