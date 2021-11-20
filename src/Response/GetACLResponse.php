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
class GetACLResponse extends Response
{
    private $acl;

    /**
     * GetACLResponse constructor.
     *
     * @param array $resp
     *                    GetLogs HTTP response body
     * @param array $header
     *                      GetLogs HTTP response header
     */
    public function __construct($resp, $header)
    {
        parent::__construct($header);
        $this->acl = null;
        if ($resp !== null) {
            $this->acl = new ACL();
            $this->acl->setFromArray($resp);
        }
    }

    public function getAcl()
    {
        return $this->acl;
    }
}
