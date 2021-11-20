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

class ListMachineGroupsRequest extends Request
{
    private $groupName;

    private $offset;

    private $size;

    /**
     *  ListMachineGroupsRequest Constructor.
     *
     * @param null|mixed $groupName
     * @param null|mixed $offset
     * @param null|mixed $size
     */
    public function __construct($groupName = null, $offset = null, $size = null)
    {
        $this->groupName = $groupName;
        $this->offset = $offset;
        $this->size = $size;
    }

    public function getGroupName()
    {
        return $this->groupName;
    }

    public function setGroupName($groupName)
    {
        $this->groupName = $groupName;
    }

    public function getOffset()
    {
        return $this->offset;
    }

    public function setOffset($offset)
    {
        $this->offset = $offset;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function setSize($size)
    {
        $this->size = $size;
    }
}
