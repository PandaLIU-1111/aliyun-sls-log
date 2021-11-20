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

class SplitShardRequest extends Request
{
    private $logstore;

    /**
     *  SplitShardRequest Constructor.
     *
     * @param mixed $project
     * @param mixed $logstore
     * @param mixed $shardId
     * @param mixed $midHash
     */
    public function __construct($project, $logstore, $shardId, $midHash)
    {
        parent::__construct($project);
        $this->logstore = $logstore;
        $this->shardId = $shardId;
        $this->midHash = $midHash;
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

    public function getMidHash()
    {
        return $this->midHash;
    }
}
