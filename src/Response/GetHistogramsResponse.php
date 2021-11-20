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

require_once realpath(dirname(__FILE__) . '/../Histogram.php');

/**
 * The response of the GetHistograms API from log service.
 */
class GetHistogramsResponse extends Response
{
    /**
     * @var string histogram query status(Complete or InComplete)
     */
    private $progress;

    /**
     * @var int logs' count that current query hits
     */
    private $count;

    /**
     * @var array Histogram array, histograms on the requested time range: [from, to)
     */
    private $histograms; // List<Histogram>

    /**
     * GetHistogramsResponse constructor.
     *
     * @param array $resp
     *                    GetHistogramsResponse HTTP response body
     * @param array $header
     *                      GetHistogramsResponse HTTP response header
     */
    public function __construct($resp, $header)
    {
        parent::__construct($header);
        $this->progress = $header['x-log-progress'];
        $this->count = $header['x-log-count'];
        $this->histograms = [];
        foreach ($resp  as $data) {
            $this->histograms[] = new Histogram($data['from'], $data['to'], $data['count'], $data['progress']);
        }
    }

    /**
     * Check if the histogram is completed.
     *
     * @return bool true if this histogram is completed
     */
    public function isCompleted()
    {
        return $this->progress == 'Complete';
    }

    /**
     * Get total logs' count that current query hits.
     *
     * @return int total logs' count that current query hits
     */
    public function getTotalCount()
    {
        return $this->count;
    }

    /**
     * Get histograms on the requested time range: [from, to).
     *
     * @return array Histogram array, histograms on the requested time range
     */
    public function getHistograms()
    {
        return $this->histograms;
    }
}
