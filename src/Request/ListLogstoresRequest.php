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

class ListLogstoresRequest extends Request
{
    /**
     *  ListLogstoresRequest constructor.
     *
     * @param string $project project name
     */
    public function __construct($project = null)
    {
        parent::__construct($project);
    }
}
