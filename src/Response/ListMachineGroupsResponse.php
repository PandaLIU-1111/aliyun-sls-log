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

/**
 * The response of the GetLog API from log service.
 */
class ListMachineGroupsResponse extends Response
{
    private $offset;

    private $size;

    private $machineGroups;

    /**
     * ListMachineGroupsResponse constructor.
     *
     * @param array $resp
     *                    GetLogs HTTP response body
     * @param array $header
     *                      GetLogs HTTP response header
     */
    public function __construct($resp, $header)
    {
        parent::__construct($header);
        $this->offset = $resp['offset'];
        $this->size = $resp['size'];
        $this->machineGroups = $resp['machinegroups'];
    }

    public function getOffset()
    {
        return $this->offset;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function getMachineGroups()
    {
        return $this->machineGroups;
    }
}
