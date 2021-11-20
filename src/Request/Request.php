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

class Request
{
    /**
     * @var string project name
     */
    private $project;

    /**
     *  Request constructor.
     *
     * @param string $project
     *                        project name
     */
    public function __construct(string $project)
    {
        $this->project = $project;
    }

    /**
     * Get project name.
     *
     * @return string project name
     */
    public function getProject(): string
    {
        return $this->project;
    }

    /**
     * Set project name.
     *
     * @param string $project
     *                        project name
     */
    public function setProject(string $project)
    {
        $this->project = $project;
    }
}
