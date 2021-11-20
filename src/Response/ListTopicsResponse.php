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

class ListTopicsResponse extends Response
{
    /**
     * @var int the number of all the topics from the response
     */
    private $count;

    /**
     * @var array topics list
     */
    private $topics;

    /**
     * @var string/null the next token from the response. If there is no more topic to list, it will return None
     */
    private $nextToken;

    /**
     * ListTopicsResponse constructor.
     *
     * @param array $resp
     *                    ListTopics HTTP response body
     * @param array $header
     *                      ListTopics HTTP response header
     */
    public function __construct($resp, $header)
    {
        parent::__construct($header);
        $this->count = $header['x-log-count'];
        $this->topics = $resp;
        $this->nextToken = $header['x-log-nexttoken'] ?? null;
    }

    /**
     * Get the number of all the topics from the response.
     *
     * @return int the number of all the topics from the response
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Get all the topics from the response.
     *
     * @return array topics list
     */
    public function getTopics()
    {
        return $this->topics;
    }

    /**
     * Return the next token from the response. If there is no more topic to list, it will return None.
     *
     * @return string/null next token used to list more topics
     */
    public function getNextToken()
    {
        return $this->nextToken;
    }
}
