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

/**
 * The request used to get histograms of a query from log service.
 */
class GetHistogramsRequest extends Request
{
    /**
     * @var string logstore name
     */
    private $logstore;

    /**
     * @var string topic name of logs
     */
    private $topic;

    /**
     * @var int the begin time
     */
    private $from;

    /**
     * @var int the end time
     */
    private $to;

    /**
     * @var string user defined query
     */
    private $query;

    /**
     *  GetHistogramsRequest constructor.
     *
     * @param string $project
     *                        project name
     * @param string $logstore
     *                         logstore name
     * @param int $from
     *                  the begin time
     * @param int $to
     *                the end time
     * @param string $topic
     *                      topic name of logs
     * @param string $query
     *                      user defined query
     */
    public function __construct($project = null, $logstore = null, $from = null, $to = null, $topic = null, $query = null)
    {
        parent::__construct($project);
        $this->logstore = $logstore;
        $this->from = $from;
        $this->to = $to;
        $this->topic = $topic;
        $this->query = $query;
    }

    /**
     * Get logstore name.
     *
     * @return string logstore name
     */
    public function getLogstore()
    {
        return $this->logstore;
    }

    /**
     * Set logstore name.
     *
     * @param string $logstore
     *                         logstore name
     */
    public function setLogstore($logstore)
    {
        $this->logstore = $logstore;
    }

    /**
     * Get topic name.
     *
     * @return string topic name
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * Set topic name.
     *
     * @param string $topic
     *                      topic name
     */
    public function setTopic($topic)
    {
        $this->topic = $topic;
    }

    /**
     * Get begin time.
     *
     * @return int begin time
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Set begin time.
     *
     * @param int $from
     *                  begin time
     */
    public function setFrom($from)
    {
        $this->from = $from;
    }

    /**
     * Get end time.
     *
     * @return int end time
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * Set end time.
     *
     * @param int $to
     *                end time
     */
    public function setTo($to)
    {
        $this->to = $to;
    }

    /**
     * Get user defined query.
     *
     * @return string user defined query
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * Set user defined query.
     *
     * @param string $query
     *                      user defined query
     */
    public function setQuery($query)
    {
        $this->query = $query;
    }
}
