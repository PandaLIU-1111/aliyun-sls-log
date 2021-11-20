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

class ListConfigsRequest extends Request
{
    private $configName;

    private $offset;

    private $size;

    /**
     *  ListConfigsRequest Constructor.
     *
     * @param null|mixed $configName
     * @param null|mixed $offset
     * @param null|mixed $size
     */
    public function __construct($configName = null, $offset = null, $size = null)
    {
        //parent::__construct ( $project );
        $this->configName = $configName;
        $this->offset = $offset;
        $this->size = $size;
    }

    public function getConfigName()
    {
        return $this->configName;
    }

    public function setConfigName($configName)
    {
        $this->configName = $configName;
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
