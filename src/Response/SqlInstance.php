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
class SqlInstance
{
    /**
     * @var string name
     */
    private $name;

    /**
     * @var int cu
     */
    private $cu;

    /**
     * @var int createTime
     */
    private $createTime;

    /**
     * @var int updateTime
     */
    private $updateTime;

    /**
     * SqlInstance constructor.
     * @param string $name
     *                     the name
     * @param int $cu
     *                cu
     * @param int createTime
     *                  create time
     * @param int updateTime
     *                  update time
     * @param mixed $createTime
     * @param mixed $updateTime
     */
    public function __construct($name, $cu, $createTime, $updateTime)
    {
        $this->name = $name;
        $this->cu = $cu;
        $this->createTime = $createTime;
        $this->updateTime = $updateTime;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getCu()
    {
        return $this->cu;
    }

    public function getCreateTime()
    {
        return $this->createTime;
    }

    public function getUpdateTime()
    {
        return $this->updateTime;
    }
}
