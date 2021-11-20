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

require_once realpath(dirname(__FILE__) . '/QueriedLog.php');

/**
 * The response of the execute sql API from log service.
 */
class ProjectSqlResponse extends Response
{
    /**
     * @var int log number
     */
    private $count;

    /**
     * @var string logs query status(Complete or InComplete)
     */
    private $progress;

    /**
     * @var array QueriedLog array, all log data
     */
    private $logs;

    /**
     * @var rows proccesed in this request
     */
    private $processedRows;

    /**
     * @var execution latency in milliseconds
     */
    private $elapsedMilli;

    /**
     * @var used cpu sec for this request
     */
    private $cpuSec;

    /**
     * @var used cpu core number for this request
     */
    private $cpuCores;

    /**
     * GetLogsResponse constructor.
     *
     * @param array $resp
     *                    GetLogs HTTP response body
     * @param array $header
     *                      GetLogs HTTP response header
     */
    public function __construct($resp, $header)
    {
        parent::__construct($header);
        $this->count = $header['x-log-count'];
        $this->progress = $header['x-log-progress'];
        $this->processedRows = $header['x-log-processed-rows'];
        $this->elapsedMilli = $header['x-log-elapsed-millisecond'];
        $this->cpuSec = $header['x-log-cpu-sec'];
        $this->cpuCores = $header['x-log-cpu-cores'];
        $this->logs = [];
        foreach ($resp  as $data) {
            $contents = $data;
            $time = $data['__time__'];
            $source = $data['__source__'];
            unset($contents['__time__'] , $contents['__source__']);

            $this->logs[] = new QueriedLog($time, $source, $contents);
        }
    }

    /**
     * Get log number from the response.
     *
     * @return int log number
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Check if the get logs query is completed.
     *
     * @return bool true if this logs query is completed
     */
    public function isCompleted()
    {
        return $this->progress == 'Complete';
    }

    /**
     * Get all logs from the response.
     *
     * @return array QueriedLog array, all log data
     */
    public function getLogs()
    {
        return $this->logs;
    }

    /**
     * get proccesedRows.
     */
    public function getProcessedRows()
    {
        return $this->processedRows;
    }

    /**
     * get elapsedMilli.
     */
    public function getElapsedMilli()
    {
        return $this->elapsedMilli;
    }

    /**
     * get cpuSec.
     */
    public function getCpuSec()
    {
        return $this->cpuSec;
    }

    /**
     * get cpuCores.
     */
    public function getCpuCores()
    {
        return $this->cpuCores;
    }
}
