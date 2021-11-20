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

class GetACLRequest extends Request
{
    private $aclId;

    /**
     *  GetACLRequest Constructor.
     *
     * @param null|mixed $aclId
     */
    public function __construct($aclId = null)
    {
        $this->aclId = $aclId;
    }

    public function getAclId()
    {
        return $this->aclId;
    }

    public function setAclId($aclId)
    {
        $this->aclId = $aclId;
    }
}
