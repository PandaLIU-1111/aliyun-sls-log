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

class ListShardsRequest extends Request
{
    private $logstore;

    /**
     *  ListShardsRequest Constructor.
     *
     * @param mixed $project
     * @param mixed $logstore
     */
    public function __construct($project, $logstore)
    {
        parent::__construct($project);
        $this->logstore = $logstore;
    }

    public function getLogstore()
    {
        return $this->logstore;
    }

    public function setLogstore($logstore)
    {
        $this->logstore = $logstore;
    }
}
