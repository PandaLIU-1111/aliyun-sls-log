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

class GetConfigRequest extends Request
{
    private $configName;

    /**
     *  GetConfigRequest Constructor.
     *
     * @param null|mixed $configName
     */
    public function __construct($configName = null)
    {
        $this->configName = $configName;
    }

    public function getConfigName()
    {
        return $this->configName;
    }

    public function setConfigName($configName)
    {
        $this->configName = $configName;
    }
}
