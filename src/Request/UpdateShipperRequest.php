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

class UpdateShipperRequest extends Request
{
    private $shipperName;

    private $targetType;

    private $targetConfigration;

    private $logStore;

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

    /**
     * @return mixed
     */
    public function getTargetType()
    {
        return $this->targetType;
    }

    /**
     * @param mixed $targetType
     */
    public function setTargetType($targetType)
    {
        $this->targetType = $targetType;
    }

    /**
     * @return mixed
     */
    public function getTargetConfigration()
    {
        return $this->targetConfigration;
    }

    /**
     * @param mixed $targetConfigration
     */
    public function setTargetConfigration($targetConfigration)
    {
        $this->targetConfigration = $targetConfigration;
    }
}
