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
namespace Hyperf\AliyunSlsLog\Request;

class MergeShardsRequest extends Request
{
    private $logstore;

    /**
     *  MergeShardsRequest Constructor.
     *
     * @param mixed $project
     * @param mixed $logstore
     * @param mixed $shardId
     */
    public function __construct($project, $logstore, $shardId)
    {
        parent::__construct($project);
        $this->logstore = $logstore;
        $this->shardId = $shardId;
    }

    public function getLogstore()
    {
        return $this->logstore;
    }

    public function setLogstore($logstore)
    {
        $this->logstore = $logstore;
    }

    public function getShardId()
    {
        return $this->shardId;
    }
}
