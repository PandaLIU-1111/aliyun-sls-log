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

require_once realpath(dirname(__FILE__) . '/Shard.php');

/**
 * The response of the GetLog API from log service.
 */
class ListShardsResponse extends Response
{
    private $shardIds;

    /**
     * ListShardsResponse constructor.
     *
     * @param array $resp
     *                    GetLogs HTTP response body
     * @param array $header
     *                      GetLogs HTTP response header
     */
    public function __construct($resp, $header)
    {
        parent::__construct($header);
        foreach ($resp as $key => $value) {
            $this->shardIds[] = $value['shardID'];
            $this->shards[] = new Shard($value['shardID'], $value['status'], $value['inclusiveBeginKey'], $value['exclusiveEndKey'], $value['createTime']);
        }
    }

    public function getShardIds()
    {
        return $this->shardIds;
    }

    public function getShards()
    {
        return $this->shards;
    }
}
