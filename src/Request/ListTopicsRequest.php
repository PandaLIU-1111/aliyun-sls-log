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

class ListTopicsRequest extends Request
{
    /**
     * @var string logstore name
     */
    private $logstore;

    /**
     * @var string the start token to list topics
     */
    private $token;

    /**
     * @var int max topic counts to return
     */
    private $line;

    /**
     *  ListTopicsRequest constructor.
     *
     * @param string $project project name
     * @param string $logstore logstore name
     * @param string $token the start token to list topics
     * @param int $line max topic counts to return
     */
    public function __construct($project = null, $logstore = null, $token = null, $line = null)
    {
        parent::__construct($project);
        $this->logstore = $logstore;
        $this->token = $token;
        $this->line = $line;
    }

    /**
     * Get logstroe name.
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
     * Get start token to list topics.
     *
     * @return string start token to list topics
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set start token to list topics.
     *
     * @param string $token start token to list topics
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * Get max topic counts to return.
     *
     * @return int max topic counts to return
     */
    public function getLine()
    {
        return $this->line;
    }

    /**
     * Set max topic counts to return.
     *
     * @param int $line max topic counts to return
     */
    public function setLine($line)
    {
        $this->line = $line;
    }
}
