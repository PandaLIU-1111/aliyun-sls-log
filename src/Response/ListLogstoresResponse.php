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

class ListLogstoresResponse extends Response
{
    /**
     * @var int the number of total logstores from the response
     */
    private $count;

    /**
     * @var array all logstore
     */
    private $logstores;

    /**
     * ListLogstoresResponse constructor.
     *
     * @param array $resp
     *                    ListLogstores HTTP response body
     * @param array $header
     *                      ListLogstores HTTP response header
     */
    public function __construct($resp, $header)
    {
        parent::__construct($header);
        $this->count = $resp['total'];
        $this->logstores = $resp['logstores'];
    }

    /**
     * Get total count of logstores from the response.
     *
     * @return int the number of total logstores from the response
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Get all the logstores from the response.
     *
     * @return array all logstore
     */
    public function getLogstores()
    {
        return $this->logstores;
    }
}
