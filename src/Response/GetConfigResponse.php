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

require_once realpath(dirname(__FILE__) . '/Config.php');
/**
 * The response of the GetLog API from log service.
 */
class GetConfigResponse extends Response
{
    private $config;

    /**
     * GetConfigResponse constructor.
     *
     * @param array $resp
     *                    GetLogs HTTP response body
     * @param array $header
     *                      GetLogs HTTP response header
     */
    public function __construct($resp, $header)
    {
        parent::__construct($header);
        $this->config = new Config();
        $this->config->setFromArray($resp);
    }

    public function getConfig()
    {
        return $this->config;
    }
}
