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

class GetShipperConfigResponse extends Response
{
    private $shipperName;

    private $targetType;

    private $targetConfigration;

    /**
     * GetShipperConfigResponse constructor.
     *
     * @param array $resp
     *                    GetLogs HTTP response body
     * @param array $header
     *                      GetLogs HTTP response header
     */
    public function __construct($resp, $header)
    {
        parent::__construct($header);
        $this->shipperName = $resp['shipperName'];
        $this->targetConfigration = $resp['targetConfiguration'];
        $this->targetType = $resp['targetType'];
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
