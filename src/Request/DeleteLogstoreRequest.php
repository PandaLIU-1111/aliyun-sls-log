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

/**
 * The request used to delete logstore from log service.
 */
class DeleteLogstoreRequest extends Request
{
    private $logstore;

    /**
     *  DeleteLogstoreRequest constructor.
     *
     * @param string $project project name
     * @param null|mixed $logstore
     */
    public function __construct($project = null, $logstore = null)
    {
        parent::__construct($project);
        $this->logstore = $logstore;
    }

    public function getLogstore()
    {
        return $this->logstore;
    }
}
