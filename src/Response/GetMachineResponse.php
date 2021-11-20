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
class GetMachineResponse extends Response
{
    private $machine;

    /**
     * GetMachineResponse constructor.
     *
     * @param array $resp
     *                    GetLogs HTTP response body
     * @param array $header
     *                      GetLogs HTTP response header
     */
    public function __construct($resp, $header)
    {
        parent::__construct($header);
        //echo json_encode($resp);
        $this->machine = new Machine();
        $this->machine->setFromArray($resp);
    }

    public function getMachine()
    {
        return $this->machine;
    }
}
