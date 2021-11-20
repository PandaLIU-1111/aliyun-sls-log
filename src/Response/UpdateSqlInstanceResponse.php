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
 * The response of the UpdateSqlInstance API from log service.
 */
class UpdateSqlInstanceResponse extends Response
{
    /**
     * UpdateSqlInstanceResponse constructor.
     *
     * @param array $resp
     *                    UpdateSqlInstance HTTP response body
     * @param array $header
     *                      UpdateSqlInstance HTTP response header
     */
    public function __construct($resp, $header)
    {
        parent::__construct($header);
    }
}
