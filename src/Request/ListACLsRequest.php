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

class ListACLsRequest extends Request
{
    private $offset;

    private $size;

    private $principleId;

    /**
     *  ListACLsRequest Constructor.
     *
     * @param null|mixed $principleId
     * @param null|mixed $offset
     * @param null|mixed $size
     */
    public function __construct($principleId = null, $offset = null, $size = null)
    {
        $this->offset = $offset;
        $this->size = $size;
        $this->principleId = $principleId;
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

    public function getPrincipleId()
    {
        return $this->principleId;
    }

    public function setPrincipleId($principleId)
    {
        $this->principleId = $principleId;
    }
}
