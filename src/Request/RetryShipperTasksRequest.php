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

class RetryShipperTasksRequest extends Request
{
    private $shipperName;

    private $logStore;

    private $taskLists;

    /**
     *  CreateShipperRequest Constructor.
     *
     * @param mixed $project
     */
    public function __construct($project)
    {
        parent::__construct($project);
    }

    /**
     * @return mixed
     */
    public function getTaskLists()
    {
        return $this->taskLists;
    }

    /**
     * @param mixed $taskLists
     */
    public function setTaskLists($taskLists)
    {
        $this->taskLists = $taskLists;
    }

    /**
     * @return mixed
     */
    public function getLogStore()
    {
        return $this->logStore;
    }

    /**
     * @param mixed $logStore
     */
    public function setLogStore($logStore)
    {
        $this->logStore = $logStore;
    }

    /**
     * @return mixed
     */
    public function getShipperName()
    {
        return $this->shipperName;
    }

    /**
     * @param mixed $shipperName
     */
    public function setShipperName($shipperName)
    {
        $this->shipperName = $shipperName;
    }
}
