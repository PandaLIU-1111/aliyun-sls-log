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

/**
 * The request used to Update logstore from log service.
 */
class UpdateLogstoreRequest extends Request
{
    private $logstore;

    private $ttl;

    private $shardCount;

    /**
     *  UpdateLogstoreRequest constructor.
     *
     * @param string $project project name
     * @param null|mixed $logstore
     * @param null|mixed $ttl
     * @param null|mixed $shardCount
     */
    public function __construct($project = null, $logstore = null, $ttl = null, $shardCount = null)
    {
        parent::__construct($project);
        $this->logstore = $logstore;
        $this->ttl = $ttl;
        $this->shardCount = $shardCount;
    }

    public function getLogstore()
    {
        return $this->logstore;
    }

    public function getTtl()
    {
        return $this->ttl;
    }

    public function getShardCount()
    {
        return $this->shardCount;
    }
}
