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

class UpdateACLRequest extends Request
{
    private $acl;

    /**
     *  UpdateACLRequest Constructor.
     *
     * @param mixed $acl
     */
    public function __construct($acl)
    {
        $this->acl = $acl;
    }

    public function getAcl()
    {
        return $this->acl;
    }

    public function setAcl($acl)
    {
        $this->acl = $acl;
    }
}
