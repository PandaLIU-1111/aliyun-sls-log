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

class GetMachineRequest extends Request
{
    private $uuid;

    /**
     *  GetMachineRequest Constructor.
     *
     * @param null|mixed $uuid
     */
    public function __construct($uuid = null)
    {
        $this->uuid = $uuid;
    }

    public function getUuid()
    {
        return $this->uuid;
    }

    public function setUuid($uuid)
    {
        $this->uuid = $uuid;
    }
}
