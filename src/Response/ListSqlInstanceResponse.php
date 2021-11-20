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

require_once realpath(dirname(__FILE__) . '/SqlInstance.php');

/**
 * The response of the ListSqlInstance API from log service.
 */
class ListSqlInstanceResponse extends Response
{
    private $sqlInstances;

    /**
     * ListSqlInstanceResponse constructor.
     *
     * @param array $resp
     *                    ListSqlInstance HTTP response body
     * @param array $header
     *                      ListSqlInstance HTTP response header
     */
    public function __construct($resp, $header)
    {
        parent::__construct($header);
        $arr = $resp;
        if ($arr != null) {
            foreach ($arr as $data) {
                $name = $data['name'];
                $cu = $data['cu'];
                $createTime = $data['createTime'];
                $updateTime = $data['updateTime'];
                $this->sqlInstances[] = new SqlInstance($name, $cu, $createTime, $updateTime);
            }
        }
    }
}
