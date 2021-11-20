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

class UpdateMachineGroupRequest extends Request
{
    private $machineGroup;

    /**
     *  UpdateMachineGroupRequest Constructor.
     *
     * @param mixed $machineGroup
     */
    public function __construct($machineGroup)
    {
        $this->machineGroup = $machineGroup;
    }

    public function getMachineGroup()
    {
        return $this->machineGroup;
    }

    public function setMachineGroup($machineGroup)
    {
        $this->machineGroup = $machineGroup;
    }
}
