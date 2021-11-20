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

class GetMachineGroupRequest extends Request
{
    private $groupName;

    /**
     *  GetMachineGroupRequest Constructor.
     *
     * @param null|mixed $groupName
     */
    public function __construct($groupName = null)
    {
        $this->groupName = $groupName;
    }

    public function getGroupName()
    {
        return $this->groupName;
    }

    public function setGroupName($groupName)
    {
        $this->groupName = $groupName;
    }
}
