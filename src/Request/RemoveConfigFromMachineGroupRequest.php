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

class RemoveConfigFromMachineGroupRequest extends Request
{
    private $groupName;

    private $configName;

    /**
     *  RemoveConfigFromMachineGroupRequest Constructor.
     *
     * @param null|mixed $groupName
     * @param null|mixed $configName
     */
    public function __construct($groupName = null, $configName = null)
    {
        $this->groupName = $groupName;
        $this->configName = $configName;
    }

    public function getGroupName()
    {
        return $this->groupName;
    }

    public function setGroupName($groupName)
    {
        $this->groupName = $groupName;
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
