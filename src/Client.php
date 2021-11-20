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
namespace Hyperf\AliyunSlsLog;

use Hyperf\AliyunSlsLog\Exception\AliYunLogException;
use Hyperf\AliyunSlsLog\Request\ApplyConfigToMachineGroupRequest;
use Hyperf\AliyunSlsLog\Request\BatchGetLogsRequest;
use Hyperf\AliyunSlsLog\Request\CreateACLRequest;
use Hyperf\AliyunSlsLog\Request\CreateLogstoreRequest;
use Hyperf\AliyunSlsLog\Request\CreateMachineGroupRequest;
use Hyperf\AliyunSlsLog\Request\CreateShipperRequest;
use Hyperf\AliyunSlsLog\Request\DeleteACLRequest;
use Hyperf\AliyunSlsLog\Request\DeleteLogstoreRequest;
use Hyperf\AliyunSlsLog\Request\DeleteMachineGroupRequest;
use Hyperf\AliyunSlsLog\Request\DeleteShardRequest;
use Hyperf\AliyunSlsLog\Request\DeleteShipperRequest;
use Hyperf\AliyunSlsLog\Request\GetACLRequest;
use Hyperf\AliyunSlsLog\Request\GetCursorRequest;
use Hyperf\AliyunSlsLog\Request\GetHistogramsRequest;
use Hyperf\AliyunSlsLog\Request\GetLogsRequest;
use Hyperf\AliyunSlsLog\Request\GetMachineGroupRequest;
use Hyperf\AliyunSlsLog\Request\GetMachineRequest;
use Hyperf\AliyunSlsLog\Request\GetProjectLogsRequest;
use Hyperf\AliyunSlsLog\Request\GetShipperConfigRequest;
use Hyperf\AliyunSlsLog\Request\GetShipperTasksRequest;
use Hyperf\AliyunSlsLog\Request\ListACLsRequest;
use Hyperf\AliyunSlsLog\Request\ListConfigsRequest;
use Hyperf\AliyunSlsLog\Request\ListLogstoresRequest;
use Hyperf\AliyunSlsLog\Request\ListMachineGroupsRequest;
use Hyperf\AliyunSlsLog\Request\ListShardsRequest;
use Hyperf\AliyunSlsLog\Request\ListShipperRequest;
use Hyperf\AliyunSlsLog\Request\ListTopicsRequest;
use Hyperf\AliyunSlsLog\Request\LogStoreSqlRequest;
use Hyperf\AliyunSlsLog\Request\MergeShardsRequest;
use Hyperf\AliyunSlsLog\Request\ProjectSqlRequest;
use Hyperf\AliyunSlsLog\Request\PutLogsRequest;
use Hyperf\AliyunSlsLog\Request\RemoveConfigFromMachineGroupRequest;
use Hyperf\AliyunSlsLog\Request\RetryShipperTasksRequest;
use Hyperf\AliyunSlsLog\Request\SplitShardRequest;
use Hyperf\AliyunSlsLog\Request\UpdateACLRequest;
use Hyperf\AliyunSlsLog\Request\UpdateLogstoreRequest;
use Hyperf\AliyunSlsLog\Request\UpdateMachineGroupRequest;
use Hyperf\AliyunSlsLog\Request\UpdateShipperRequest;
use Hyperf\AliyunSlsLog\Response\ApplyConfigToMachineGroupResponse;
use Hyperf\AliyunSlsLog\Response\BatchGetLogsResponse;
use Hyperf\AliyunSlsLog\Response\CreateACLResponse;
use Hyperf\AliyunSlsLog\Response\CreateLogstoreResponse;
use Hyperf\AliyunSlsLog\Response\CreateMachineGroupResponse;
use Hyperf\AliyunSlsLog\Response\CreateShipperResponse;
use Hyperf\AliyunSlsLog\Response\CreateSqlInstanceResponse;
use Hyperf\AliyunSlsLog\Response\DeleteACLResponse;
use Hyperf\AliyunSlsLog\Response\DeleteConfigResponse;
use Hyperf\AliyunSlsLog\Response\DeleteLogstoreResponse;
use Hyperf\AliyunSlsLog\Response\DeleteMachineGroupResponse;
use Hyperf\AliyunSlsLog\Response\DeleteShardResponse;
use Hyperf\AliyunSlsLog\Response\DeleteShipperResponse;
use Hyperf\AliyunSlsLog\Response\GetACLResponse;
use Hyperf\AliyunSlsLog\Response\GetCursorResponse;
use Hyperf\AliyunSlsLog\Response\GetHistogramsResponse;
use Hyperf\AliyunSlsLog\Response\GetLogsResponse;
use Hyperf\AliyunSlsLog\Response\GetMachineGroupResponse;
use Hyperf\AliyunSlsLog\Response\GetMachineResponse;
use Hyperf\AliyunSlsLog\Response\GetShipperConfigResponse;
use Hyperf\AliyunSlsLog\Response\GetShipperTasksResponse;
use Hyperf\AliyunSlsLog\Response\ListACLsResponse;
use Hyperf\AliyunSlsLog\Response\ListConfigsResponse;
use Hyperf\AliyunSlsLog\Response\ListLogstoresResponse;
use Hyperf\AliyunSlsLog\Response\ListMachineGroupsResponse;
use Hyperf\AliyunSlsLog\Response\ListShardsResponse;
use Hyperf\AliyunSlsLog\Response\ListShipperResponse;
use Hyperf\AliyunSlsLog\Response\ListSqlInstanceResponse;
use Hyperf\AliyunSlsLog\Response\ListTopicsResponse;
use Hyperf\AliyunSlsLog\Response\LogStoreSqlResponse;
use Hyperf\AliyunSlsLog\Response\ProjectSqlResponse;
use Hyperf\AliyunSlsLog\Response\PutLogsResponse;
use Hyperf\AliyunSlsLog\Response\RemoveConfigFromMachineGroupResponse;
use Hyperf\AliyunSlsLog\Response\RetryShipperTasksResponse;
use Hyperf\AliyunSlsLog\Response\UpdateACLResponse;
use Hyperf\AliyunSlsLog\Response\UpdateLogstoreResponse;
use Hyperf\AliyunSlsLog\Response\UpdateMachineGroupResponse;
use Hyperf\AliyunSlsLog\Response\UpdateShipperResponse;
use Hyperf\AliyunSlsLog\Response\UpdateSqlInstanceResponse;
use Hyperf\Contract\ConfigInterface;
use Hyperf\Guzzle\ClientFactory;
use Hyperf\Utils\ApplicationContext;

class Client
{
    public const API_VERSION = '0.6.0';

    public const USER_AGENT = 'log-php-sdk-v-0.6.0';

    /**
     * @var string aliyun accessKey
     */
    protected $accessKey;

    /**
     * @var string aliyun accessKeyId
     */
    protected $accessKeyId;

    /**
     *@var string aliyun sts token
     */
    protected $stsToken;

    /**
     * @var string LOG endpoint
     */
    protected $endpoint;

    /**
     * @var string check if the host if row ip
     */
    protected $isRowIp;

    /**
     * @var int Http send port. The dafault value is 80.
     */
    protected $port;

    /**
     * @var string log sever host
     */
    protected $logHost;

    /**
     * @var string the local machine ip address
     */
    protected $source;

    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * Aliyun_Log_Client constructor.
     *
     * @param string $endpoint
     *                         LOG host name, for example, http://cn-hangzhou.sls.aliyuncs.com
     * @param string $accessKeyId
     *                            aliyun accessKeyId
     * @param string $accessKey
     *                          aliyun accessKey
     * @param mixed $token
     */
    public function __construct(string $config = 'default')
    {
        $container = ApplicationContext::getContainer();
        $clientFactory = $container->get(ClientFactory::class);
        $hyperConfig = $container->get(ConfigInterface::class);
        $this->client = $clientFactory->create();
        $this->setEndpoint($hyperConfig->get(sprintf('aliyun-sls-log.%s.endpoint', $config), ''));
        $this->accessKeyId = $hyperConfig->get(sprintf('aliyun-sls-log.%s.access_key_id', $config), '');
        $this->accessKey = $hyperConfig->get(sprintf('aliyun-sls-log.%s.access_key', $config), '');
        $this->stsToken = $hyperConfig->get(sprintf('aliyun-sls-log.%s.stsToken', $config), '');
        $this->source = Util::getLocalIp();
    }

    /**
     * Put logs to Log Service.
     * Unsuccessful opertaion will cause an AliYunLogException.
     *
     * @param PutLogsRequest $request the PutLogs request parameters class
     * @throws AliYunLogException
     * @return PutLogsResponse
     */
    public function putLogs(PutLogsRequest $request)
    {
        if (count($request->getLogitems()) > 4096) {
            throw new AliYunLogException('InvalidLogSize', "logItems' length exceeds maximum limitation: 4096 lines.");
        }

        $logGroup = new LogGroup();
        $topic = $request->getTopic() !== null ? $request->getTopic() : '';
        $logGroup->setTopic($request->getTopic());
        $source = $request->getSource();

        if (! $source) {
            $source = $this->source;
        }
        $logGroup->setSource($source);
        $logitems = $request->getLogitems();
        foreach ($logitems as $logItem) {
            $log = new Log();
            $log->setTime($logItem->getTime());
            $content = $logItem->getContents();
            foreach ($content as $key => $value) {
                $content = new Log_Content();
                $content->setKey($key);
                $content->setValue($value);
                $log->addContents($content);
            }

            $logGroup->addLogs($log);
        }

        $body = Util::toBytes($logGroup);
        unset($logGroup);

        $bodySize = strlen($body);
        if ($bodySize > 3 * 1024 * 1024) { // 3 MB
            throw new AliYunLogException('InvalidLogSize' . "logItems' size exceeds maximum limitation: 3 MB.");
        }
        $params = [];
        $headers = [];
        $headers['x-log-bodyrawsize'] = $bodySize;
        $headers['x-log-compresstype'] = 'deflate';
        $headers['Content-Type'] = 'application/x-protobuf';
        $body = gzcompress($body, 6);

        $logstore = $request->getLogstore() !== null ? $request->getLogstore() : '';
        $project = $request->getProject() !== null ? $request->getProject() : '';
        $shardKey = $request->getShardKey();
        $resource = '/logstores/' . $logstore . ($shardKey == null ? '/shards/lb' : '/shards/route');
        if ($shardKey) {
            $params['key'] = $shardKey;
        }
        [$resp, $header] = $this->send('POST', $project, $body, $resource, $params, $headers);
        $requestId = isset($header['x-log-requestid']) ? $header['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return new PutLogsResponse($header);
    }

    /**
     * create shipper service.
     * @param CreateShipperRequest $request
     *                                      return CreateShipperResponse
     */
    public function createShipper(CreateShipperRequest $request)
    {
        $headers = [];
        $params = [];
        $resource = '/logstores/' . $request->getLogStore() . '/shipper';
        $project = $request->getProject() !== null ? $request->getProject() : '';
        $headers['Content-Type'] = 'application/json';

        $body = [
            'shipperName' => $request->getShipperName(),
            'targetType' => $request->getTargetType(),
            'targetConfiguration' => $request->getTargetConfigration(),
        ];
        $body_str = json_encode($body);
        $headers['x-log-bodyrawsize'] = strlen($body_str);
        [$resp, $header] = $this->send('POST', $project, $body_str, $resource, $params, $headers);
        $requestId = isset($header['x-log-requestid']) ? $header['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return new CreateShipperResponse($resp, $header);
    }

    /**
     * create shipper service.
     * @param UpdateShipperRequest $request
     *                                      return UpdateShipperResponse
     */
    public function updateShipper(UpdateShipperRequest $request)
    {
        $headers = [];
        $params = [];
        $resource = '/logstores/' . $request->getLogStore() . '/shipper/' . $request->getShipperName();
        $project = $request->getProject() !== null ? $request->getProject() : '';
        $headers['Content-Type'] = 'application/json';

        $body = [
            'shipperName' => $request->getShipperName(),
            'targetType' => $request->getTargetType(),
            'targetConfiguration' => $request->getTargetConfigration(),
        ];
        $body_str = json_encode($body);
        $headers['x-log-bodyrawsize'] = strlen($body_str);
        [$resp, $header] = $this->send('PUT', $project, $body_str, $resource, $params, $headers);
        $requestId = isset($header['x-log-requestid']) ? $header['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return new UpdateShipperResponse($resp, $header);
    }

    /**
     * get shipper tasks list, max 48 hours duration supported.
     * @param GetShipperTasksRequest $request
     *                                        return GetShipperTasksResponse
     */
    public function getShipperTasks(GetShipperTasksRequest $request)
    {
        $headers = [];
        $params = [
            'from' => $request->getStartTime(),
            'to' => $request->getEndTime(),
            'status' => $request->getStatusType(),
            'offset' => $request->getOffset(),
            'size' => $request->getSize(),
        ];
        $resource = '/logstores/' . $request->getLogStore() . '/shipper/' . $request->getShipperName() . '/tasks';
        $project = $request->getProject() !== null ? $request->getProject() : '';
        $headers['x-log-bodyrawsize'] = 0;
        $headers['Content-Type'] = 'application/json';

        [$resp, $header] = $this->send('GET', $project, null, $resource, $params, $headers);
        $requestId = isset($header['x-log-requestid']) ? $header['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return new GetShipperTasksResponse($resp, $header);
    }

    /**
     * retry shipper tasks list by task ids.
     * @param RetryShipperTasksRequest $request
     *                                          return RetryShipperTasksResponse
     */
    public function retryShipperTasks(RetryShipperTasksRequest $request)
    {
        $headers = [];
        $params = [];
        $resource = '/logstores/' . $request->getLogStore() . '/shipper/' . $request->getShipperName() . '/tasks';
        $project = $request->getProject() !== null ? $request->getProject() : '';

        $headers['Content-Type'] = 'application/json';
        $body = $request->getTaskLists();
        $body_str = json_encode($body);
        $headers['x-log-bodyrawsize'] = strlen($body_str);
        [$resp, $header] = $this->send('PUT', $project, $body_str, $resource, $params, $headers);
        $requestId = isset($header['x-log-requestid']) ? $header['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return new RetryShipperTasksResponse($resp, $header);
    }

    /**
     * delete shipper service.
     * @param DeleteShipperRequest $request
     *                                      return DeleteShipperResponse
     */
    public function deleteShipper(DeleteShipperRequest $request)
    {
        $headers = [];
        $params = [];
        $resource = '/logstores/' . $request->getLogStore() . '/shipper/' . $request->getShipperName();
        $project = $request->getProject() !== null ? $request->getProject() : '';
        $headers['x-log-bodyrawsize'] = 0;
        $headers['Content-Type'] = 'application/json';

        [$resp, $header] = $this->send('DELETE', $project, null, $resource, $params, $headers);
        $requestId = isset($header['x-log-requestid']) ? $header['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return new DeleteShipperResponse($resp, $header);
    }

    /**
     * get shipper config service.
     * @param GetShipperConfigRequest $request
     *                                         return GetShipperConfigResponse
     */
    public function getShipperConfig(GetShipperConfigRequest $request)
    {
        $headers = [];
        $params = [];
        $resource = '/logstores/' . $request->getLogStore() . '/shipper/' . $request->getShipperName();
        $project = $request->getProject() !== null ? $request->getProject() : '';
        $headers['x-log-bodyrawsize'] = 0;
        $headers['Content-Type'] = 'application/json';

        [$resp, $header] = $this->send('GET', $project, null, $resource, $params, $headers);
        $requestId = isset($header['x-log-requestid']) ? $header['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return new GetShipperConfigResponse($resp, $header);
    }

    /**
     * list shipper service.
     * @param ListShipperRequest $request
     *                                    return ListShipperResponse
     */
    public function listShipper(ListShipperRequest $request)
    {
        $headers = [];
        $params = [];
        $resource = '/logstores/' . $request->getLogStore() . '/shipper';
        $project = $request->getProject() !== null ? $request->getProject() : '';
        $headers['x-log-bodyrawsize'] = 0;
        $headers['Content-Type'] = 'application/json';

        [$resp, $header] = $this->send('GET', $project, null, $resource, $params, $headers);
        $requestId = isset($header['x-log-requestid']) ? $header['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return new ListShipperResponse($resp, $header);
    }

    /**
     * create logstore
     * Unsuccessful opertaion will cause an AliYunLogException.
     *
     * @param CreateLogstoreRequest $request the CreateLogStore request parameters class
     * @throws AliYunLogException
     *                            return CreateLogstoreResponse
     */
    public function createLogstore(CreateLogstoreRequest $request)
    {
        $headers = [];
        $params = [];
        $resource = '/logstores';
        $project = $request->getProject() !== null ? $request->getProject() : '';
        $headers['x-log-bodyrawsize'] = 0;
        $headers['Content-Type'] = 'application/json';
        $body = [
            'logstoreName' => $request->getLogstore(),
            'ttl' => (int) ($request->getTtl()),
            'shardCount' => (int) ($request->getShardCount()),
        ];
        $body_str = json_encode($body);
        $headers['x-log-bodyrawsize'] = strlen($body_str);
        [$resp, $header] = $this->send('POST', $project, $body_str, $resource, $params, $headers);
        $requestId = isset($header['x-log-requestid']) ? $header['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return new CreateLogstoreResponse($resp, $header);
    }

    /**
     * update logstore
     * Unsuccessful opertaion will cause an AliYunLogException.
     *
     * @param UpdateLogstoreRequest $request the UpdateLogStore request parameters class
     * @throws AliYunLogException
     *                            return UpdateLogstoreResponse
     */
    public function updateLogstore(UpdateLogstoreRequest $request)
    {
        $headers = [];
        $params = [];
        $project = $request->getProject() !== null ? $request->getProject() : '';
        $headers['Content-Type'] = 'application/json';
        $body = [
            'logstoreName' => $request->getLogstore(),
            'ttl' => (int) ($request->getTtl()),
            'shardCount' => (int) ($request->getShardCount()),
        ];
        $resource = '/logstores/' . $request->getLogstore();
        $body_str = json_encode($body);
        $headers['x-log-bodyrawsize'] = strlen($body_str);
        [$resp, $header] = $this->send('PUT', $project, $body_str, $resource, $params, $headers);
        $requestId = isset($header['x-log-requestid']) ? $header['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return new UpdateLogstoreResponse($resp, $header);
    }

    /**
     * List all logstores of requested project.
     * Unsuccessful opertaion will cause an AliYunLogException.
     *
     * @param ListLogstoresRequest $request the ListLogstores request parameters class
     * @throws AliYunLogException
     * @return ListLogstoresResponse
     */
    public function listLogstores(ListLogstoresRequest $request)
    {
        $headers = [];
        $params = [];
        $resource = '/logstores';
        $project = $request->getProject() !== null ? $request->getProject() : '';
        [$resp, $header] = $this->send('GET', $project, null, $resource, $params, $headers);
        $requestId = isset($header['x-log-requestid']) ? $header['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return new ListLogstoresResponse($resp, $header);
    }

    /**
     * Delete logstore
     * Unsuccessful opertaion will cause an AliYunLogException.
     *
     * @param DeleteLogstoreRequest $request the DeleteLogstores request parameters class
     *@throws AliYunLogException
     * @return DeleteLogstoreResponse
     */
    public function deleteLogstore(DeleteLogstoreRequest $request)
    {
        $headers = [];
        $params = [];
        $project = $request->getProject() !== null ? $request->getProject() : '';
        $logstore = $request->getLogstore() != null ? $request->getLogstore() : '';
        $resource = "/logstores/{$logstore}";
        [$resp, $header] = $this->send('DELETE', $project, null, $resource, $params, $headers);
        $requestId = isset($header['x-log-requestid']) ? $header['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return new DeleteLogstoreResponse($resp, $header);
    }

    /**
     * List all topics in a logstore.
     * Unsuccessful opertaion will cause an AliYunLogException.
     *
     * @param ListTopicsRequest $request the ListTopics request parameters class
     */
    public function listTopics(ListTopicsRequest $request): ListTopicsResponse
    {
        $headers = $params = [];
        if ($request->getToken() !== null) {
            $params['token'] = $request->getToken();
        }
        if ($request->getLine() !== null) {
            $params['line'] = $request->getLine();
        }
        $params['type'] = 'topic';
        $logstore = $request->getLogstore() !== null ? $request->getLogstore() : '';
        $project = $request->getProject() !== null ? $request->getProject() : '';
        $resource = "/logstores/{$logstore}";
        [$resp, $header] = $this->send('GET', $project, null, $resource, $params, $headers);
        $requestId = isset($header['x-log-requestid']) ? $header['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return new ListTopicsResponse($resp, $header);
    }

    /**
     * Get histograms of requested query from log service.
     * Unsuccessful opertaion will cause an AliYunLogException.
     *
     * @param GetHistogramsRequest $request the GetHistograms request parameters class
     * @throws AliYunLogException
     * @return array(json body, http header)
     */
    public function getHistogramsJson(GetHistogramsRequest $request)
    {
        $headers = [];
        $params = [];
        if ($request->getTopic() !== null) {
            $params['topic'] = $request->getTopic();
        }
        if ($request->getFrom() !== null) {
            $params['from'] = $request->getFrom();
        }
        if ($request->getTo() !== null) {
            $params['to'] = $request->getTo();
        }
        if ($request->getQuery() !== null) {
            $params['query'] = $request->getQuery();
        }
        $params['type'] = 'histogram';
        $logstore = $request->getLogstore() !== null ? $request->getLogstore() : '';
        $project = $request->getProject() !== null ? $request->getProject() : '';
        $resource = "/logstores/{$logstore}";
        [$resp, $header] = $this->send('GET', $project, null, $resource, $params, $headers);
        $requestId = isset($header['x-log-requestid']) ? $header['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return [$resp, $header];
    }

    /**
     * Get histograms of requested query from log service.
     * Unsuccessful opertaion will cause an AliYunLogException.
     *
     * @param GetHistogramsRequest $request the GetHistograms request parameters class
     * @throws AliYunLogException
     * @return GetHistogramsResponse
     */
    public function getHistograms(GetHistogramsRequest $request)
    {
        $ret = $this->getHistogramsJson($request);
        $resp = $ret[0];
        $header = $ret[1];
        return new GetHistogramsResponse($resp, $header);
    }

    /**
     * Get logs from Log service.
     * Unsuccessful opertaion will cause an AliYunLogException.
     *
     * @param GetLogsRequest $request the GetLogs request parameters class
     * @throws AliYunLogException
     * @return array(json body, http header)
     */
    public function getLogsJson(GetLogsRequest $request)
    {
        $headers = [];
        $params = [];
        if ($request->getTopic() !== null) {
            $params['topic'] = $request->getTopic();
        }
        if ($request->getFrom() !== null) {
            $params['from'] = $request->getFrom();
        }
        if ($request->getTo() !== null) {
            $params['to'] = $request->getTo();
        }
        if ($request->getQuery() !== null) {
            $params['query'] = $request->getQuery();
        }
        $params['type'] = 'log';
        if ($request->getLine() !== null) {
            $params['line'] = $request->getLine();
        }
        if ($request->getOffset() !== null) {
            $params['offset'] = $request->getOffset();
        }
        if ($request->getOffset() !== null) {
            $params['reverse'] = $request->getReverse() ? 'true' : 'false';
        }
        if ($request->getPowerSql() != null) {
            $params['powerSql'] = $request->getPowerSql() ? 'true' : 'false';
        }
        $logstore = $request->getLogstore() !== null ? $request->getLogstore() : '';
        $project = $request->getProject() !== null ? $request->getProject() : '';
        $resource = "/logstores/{$logstore}";
        [$resp, $header] = $this->send('GET', $project, null, $resource, $params, $headers);
        $requestId = isset($header['x-log-requestid']) ? $header['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return [$resp, $header];
    }

    /**
     * Get logs from Log service.
     * Unsuccessful opertaion will cause an AliYunLogException.
     *
     * @param GetLogsRequest $request the GetLogs request parameters class
     * @throws AliYunLogException
     * @return GetLogsResponse
     */
    public function getLogs(GetLogsRequest $request)
    {
        $ret = $this->getLogsJson($request);
        $resp = $ret[0];
        $header = $ret[1];
        return new GetLogsResponse($resp, $header);
    }

    /**
     * Get logs from Log service.
     * Unsuccessful opertaion will cause an AliYunLogException.
     *
     * @param GetProjectLogsRequest $request the GetLogs request parameters class
     * @throws AliYunLogException
     * @return array(json body, http header)
     */
    public function getProjectLogsJson(GetProjectLogsRequest $request)
    {
        $headers = [];
        $params = [];
        if ($request->getQuery() !== null) {
            $params['query'] = $request->getQuery();
        }
        if ($request->getPowerSql() != null) {
            $params['powerSql'] = $request->getPowerSql() ? 'true' : 'false';
        }
        $project = $request->getProject() !== null ? $request->getProject() : '';
        $resource = '/logs';
        [$resp, $header] = $this->send('GET', $project, null, $resource, $params, $headers);
        $requestId = isset($header['x-log-requestid']) ? $header['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return [$resp, $header];
        //return new GetLogsResponse ( $resp, $header );
    }

    /**
     * Get logs from Log service.
     * Unsuccessful opertaion will cause an AliYunLogException.
     *
     * @param GetProjectLogsRequest $request the GetLogs request parameters class
     * @throws AliYunLogException
     * @return GetLogsResponse
     */
    public function getProjectLogs(GetProjectLogsRequest $request)
    {
        $ret = $this->getProjectLogsJson($request);
        $resp = $ret[0];
        $header = $ret[1];
        return new GetLogsResponse($resp, $header);
    }

    /**
     * execute sql on logstore
     * Unsuccessful opertaion will cause an AliYunLogException.
     * @param LogStoreSqlRequest $request the executeLogStoreSql request parameters class
     * @throws AliYunLogException
     * @return LogStoreSqlResponse
     */
    public function executeLogStoreSql(LogStoreSqlRequest $request)
    {
        $headers = [];
        $params = [];
        if ($request->getFrom() !== null) {
            $params['from'] = $request->getFrom();
        }
        if ($request->getTo() !== null) {
            $params['to'] = $request->getTo();
        }
        if ($request->getQuery() !== null) {
            $params['query'] = $request->getQuery();
        }
        $params['type'] = 'log';
        if ($request->getPowerSql() != null) {
            $params['powerSql'] = $request->getPowerSql() ? 'true' : 'false';
        }
        $logstore = $request->getLogstore() !== null ? $request->getLogstore() : '';
        $project = $request->getProject() !== null ? $request->getProject() : '';
        $resource = "/logstores/{$logstore}";
        [$resp, $header] = $this->send('GET', $project, null, $resource, $params, $headers);
        $requestId = isset($header['x-log-requestid']) ? $header['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return new LogStoreSqlResponse($resp, $header);
    }

    /**
     * exeucte project sql.
     * Unsuccessful opertaion will cause an AliYunLogException.
     *
     * @param ProjectSqlRequest $request the GetLogs request parameters class
     * @throws AliYunLogException
     * @return array(json body, http header)
     */
    public function executeProjectSqlJson(ProjectSqlRequest $request)
    {
        $headers = [];
        $params = [];
        if ($request->getQuery() !== null) {
            $params['query'] = $request->getQuery();
        }
        if ($request->getPowerSql() != null) {
            $params['powerSql'] = $request->getPowerSql() ? 'true' : 'false';
        }
        $project = $request->getProject() !== null ? $request->getProject() : '';
        $resource = '/logs';
        [$resp, $header] = $this->send('GET', $project, null, $resource, $params, $headers);
        $requestId = isset($header['x-log-requestid']) ? $header['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return [$resp, $header];
        //return new GetLogsResponse ( $resp, $header );
    }

    /**
     * Get logs from Log service.
     * Unsuccessful opertaion will cause an AliYunLogException.
     *
     * @param GetProjectLogsRequest $request the GetLogs request parameters class
     *@throws AliYunLogException
     * @return ProjectSqlResponse
     */
    public function executeProjectSql(ProjectSqlRequest $request)
    {
        $ret = $this->executeProjectSqlJson($request);
        $resp = $ret[0];
        $header = $ret[1];
        return new ProjectSqlResponse($resp, $header);
    }

    /**
     * create sql instance api
     * Unsuccessful opertaion will cause an AliYunLogException.
     * @param $project is project name
     * @param $cu is max cores used concurrently in a project
     * @throws AliYunLogException
     * @return CreateSqlInstanceResponse
     */
    public function createSqlInstance($project, $cu)
    {
        $headers = [];
        $params = [];
        $resource = '/sqlinstance';
        $headers['x-log-bodyrawsize'] = 0;
        $headers['Content-Type'] = 'application/json';
        $body = [
            'cu' => $cu,
        ];
        $body_str = json_encode($body);
        [$resp, $header] = $this->send('POST', $project, $body_str, $resource, $params, $headers);
        $requestId = isset($header['x-log-requestid']) ?
            $header['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return new CreateSqlInstanceResponse($resp, $header);
    }

    /**
     * update sql instance api
     * Unsuccessful opertaion will cause an AliYunLogException.
     * @param $project is project name
     * @param $cu is max cores used concurrently in a project
     * @throws AliYunLogException
     * @return UpdateSqlInstanceResponse
     */
    public function updateSqlInstance($project, $cu)
    {
        $headers = [];
        $params = [];
        $resource = '/sqlinstance';
        $headers['x-log-bodyrawsize'] = 0;
        $headers['Content-Type'] = 'application/json';
        $body = [
            'cu' => $cu,
        ];
        $body_str = json_encode($body);
        [$resp, $header] = $this->send('PUT', $project, $body_str, $resource, $params, $headers);
        $requestId = isset($header['x-log-requestid']) ?
            $header['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return new UpdateSqlInstanceResponse($resp, $header);
    }

    /**
     * get sql instance api
     * Unsuccessful opertaion will cause an AliYunLogException.
     * @param $project is project name
     *@throws AliYunLogException
     * @return ListSqlInstanceResponse
     */
    public function listSqlInstance($project)
    {
        $headers = [];
        $headers['Content-Type'] = 'application/x-protobuf';
        $hangzhou['Content-Length'] = '0';
        $params = [];
        $resource = '/sqlinstance';
        $body_str = '';
        [$resp, $header] = $this->send('GET', $project, $body_str, $resource, $params, $headers);
        $requestId = isset($header['x-log-requestid']) ?
            $header['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return new ListSqlInstanceResponse($resp, $header);
    }

    /**
     * Get logs from Log service with shardid conditions.
     * Unsuccessful opertaion will cause an AliYunLogException.
     *
     * @param BatchGetLogsRequest $request the BatchGetLogs request parameters class
     * @throws AliYunLogException
     * @return BatchGetLogsResponse
     */
    public function batchGetLogs(BatchGetLogsRequest $request)
    {
        $params = [];
        $headers = [];
        $project = $request->getProject() !== null ? $request->getProject() : '';
        $logstore = $request->getLogstore() !== null ? $request->getLogstore() : '';
        $shardId = $request->getShardId() !== null ? $request->getShardId() : '';
        if ($request->getCount() !== null) {
            $params['count'] = $request->getCount();
        }
        if ($request->getCursor() !== null) {
            $params['cursor'] = $request->getCursor();
        }
        if ($request->getEndCursor() !== null) {
            $params['end_cursor'] = $request->getEndCursor();
        }
        $params['type'] = 'log';
        $headers['Accept-Encoding'] = 'gzip';
        $headers['accept'] = 'application/x-protobuf';

        $resource = "/logstores/{$logstore}/shards/{$shardId}";
        [$resp, $header] = $this->send('GET', $project, null, $resource, $params, $headers);
        //$resp is a byteArray
        $resp = gzuncompress($resp);
        if ($resp === false) {
            $resp = new LogGroupList();
        } else {
            $resp = new LogGroupList($resp);
        }
        return new BatchGetLogsResponse($resp, $header);
    }

    /**
     * List Shards from Log service with Project and logstore conditions.
     * Unsuccessful opertaion will cause an AliYunLogException.
     *
     * @param ListShardsRequest $request the ListShards request parameters class
     * @throws AliYunLogException
     * @return ListShardsResponse
     */
    public function listShards(ListShardsRequest $request)
    {
        $params = [];
        $headers = [];
        $project = $request->getProject() !== null ? $request->getProject() : '';
        $logstore = $request->getLogstore() !== null ? $request->getLogstore() : '';

        $resource = '/logstores/' . $logstore . '/shards';
        [$resp, $header] = $this->send('GET', $project, null, $resource, $params, $headers);
        $requestId = isset($header['x-log-requestid']) ? $header['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return new ListShardsResponse($resp, $header);
    }

    /**
     * split a shard into two shards  with Project and logstore and shardId and midHash conditions.
     * Unsuccessful opertaion will cause an AliYunLogException.
     *
     * @param SplitShardRequest $request the SplitShard request parameters class
     * @throws AliYunLogException
     * @return ListShardsResponse
     */
    public function splitShard(SplitShardRequest $request)
    {
        $params = [];
        $headers = [];
        $project = $request->getProject() !== null ? $request->getProject() : '';
        $logstore = $request->getLogstore() !== null ? $request->getLogstore() : '';
        $shardId = $request->getShardId() !== null ? $request->getShardId() : -1;
        $midHash = $request->getMidHash() != null ? $request->getMidHash() : '';

        $resource = '/logstores/' . $logstore . '/shards/' . $shardId;
        $params['action'] = 'split';
        $params['key'] = $midHash;
        [$resp, $header] = $this->send('POST', $project, null, $resource, $params, $headers);
        $requestId = isset($header['x-log-requestid']) ? $header['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return new ListShardsResponse($resp, $header);
    }

    /**
     * merge two shards into one shard with Project and logstore and shardId and conditions.
     * Unsuccessful opertaion will cause an AliYunLogException.
     *
     * @param MergeShardsRequest $request the MergeShards request parameters class
     * @throws AliYunLogException
     * @return ListShardsResponse
     */
    public function MergeShards(MergeShardsRequest $request)
    {
        $params = [];
        $headers = [];
        $project = $request->getProject() !== null ? $request->getProject() : '';
        $logstore = $request->getLogstore() !== null ? $request->getLogstore() : '';
        $shardId = $request->getShardId() != null ? $request->getShardId() : -1;

        $resource = '/logstores/' . $logstore . '/shards/' . $shardId;
        $params['action'] = 'merge';
        [$resp, $header] = $this->send('POST', $project, null, $resource, $params, $headers);
        $requestId = isset($header['x-log-requestid']) ? $header['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return new ListShardsResponse($resp, $header);
    }

    /**
     * delete a read only shard with Project and logstore and shardId conditions.
     * Unsuccessful opertaion will cause an AliYunLogException.
     *
     * @param DeleteShardRequest $request the DeleteShard request parameters class
     *@throws AliYunLogException
     * @return DeleteShardResponse
     */
    public function DeleteShard(DeleteShardRequest $request)
    {
        $params = [];
        $headers = [];
        $project = $request->getProject() !== null ? $request->getProject() : '';
        $logstore = $request->getLogstore() !== null ? $request->getLogstore() : '';
        $shardId = $request->getShardId() != null ? $request->getShardId() : -1;

        $resource = '/logstores/' . $logstore . '/shards/' . $shardId;
        [$resp, $header] = $this->send('DELETE', $project, null, $resource, $params, $headers);
        $requestId = isset($header['x-log-requestid']) ? $header['x-log-requestid'] : '';
        return new DeleteShardResponse($header);
    }

    /**
     * Get cursor from Log service.
     * Unsuccessful opertaion will cause an AliYunLogException.
     *
     * @param GetCursorRequest $request the GetCursor request parameters class
     * @throws AliYunLogException
     * @return GetCursorResponse
     */
    public function getCursor(GetCursorRequest $request)
    {
        $params = [];
        $headers = [];
        $project = $request->getProject() !== null ? $request->getProject() : '';
        $logstore = $request->getLogstore() !== null ? $request->getLogstore() : '';
        $shardId = $request->getShardId() !== null ? $request->getShardId() : '';
        $mode = $request->getMode() !== null ? $request->getMode() : '';
        $fromTime = $request->getFromTime() !== null ? $request->getFromTime() : -1;

        if ((empty($mode) xor $fromTime == -1) == false) {
            if (! empty($mode)) {
                throw new AliYunLogException('RequestError', 'Request is failed. Mode and fromTime can not be not empty simultaneously');
            }
            throw new AliYunLogException('RequestError', 'Request is failed. Mode and fromTime can not be empty simultaneously');
        }
        if (! empty($mode) && strcmp($mode, 'begin') !== 0 && strcmp($mode, 'end') !== 0) {
            throw new AliYunLogException('RequestError', "Request is failed. Mode value invalid:{$mode}");
        }
        if ($fromTime !== -1 && (is_integer($fromTime) == false || $fromTime < 0)) {
            throw new AliYunLogException('RequestError', "Request is failed. FromTime value invalid:{$fromTime}");
        }
        $params['type'] = 'cursor';
        if ($fromTime !== -1) {
            $params['from'] = $fromTime;
        } else {
            $params['mode'] = $mode;
        }
        $resource = '/logstores/' . $logstore . '/shards/' . $shardId;
        [$resp, $header] = $this->send('GET', $project, null, $resource, $params, $headers);
        $requestId = isset($header['x-log-requestid']) ? $header['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return new GetCursorResponse($resp, $header);
    }

    public function createConfig(CreateConfigRequest $request)
    {
        $params = [];
        $headers = [];
        $body = null;
        if ($request->getConfig() !== null) {
            $body = json_encode($request->getConfig()->toArray());
        }
        $headers['Content-Type'] = 'application/json';
        $resource = '/configs';
        [$resp, $header] = $this->send('POST', null, $body, $resource, $params, $headers);
        return new CreateConfigResponse($header);
    }

    public function updateConfig(UpdateConfigRequest $request)
    {
        $params = [];
        $headers = [];
        $body = null;
        $configName = '';
        if ($request->getConfig() !== null) {
            $body = json_encode($request->getConfig()->toArray());
            $configName = ($request->getConfig()->getConfigName() !== null) ? $request->getConfig()->getConfigName() : '';
        }
        $headers['Content-Type'] = 'application/json';
        $resource = '/configs/' . $configName;
        [$resp, $header] = $this->send('PUT', null, $body, $resource, $params, $headers);
        return new UpdateConfigResponse($header);
    }

    public function getConfig(GetConfigRequest $request)
    {
        $params = [];
        $headers = [];

        $configName = ($request->getConfigName() !== null) ? $request->getConfigName() : '';

        $resource = '/configs/' . $configName;
        [$resp, $header] = $this->send('GET', null, null, $resource, $params, $headers);
        $requestId = isset($header['x-log-requestid']) ? $header['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return new GetConfigResponse($resp, $header);
    }

    public function deleteConfig(DeleteConfigRequest $request)
    {
        $params = [];
        $headers = [];
        $configName = ($request->getConfigName() !== null) ? $request->getConfigName() : '';
        $resource = '/configs/' . $configName;
        [$resp, $header] = $this->send('DELETE', null, null, $resource, $params, $headers);
        return new DeleteConfigResponse($header);
    }

    public function listConfigs(ListConfigsRequest $request)
    {
        $params = [];
        $headers = [];

        if ($request->getConfigName() !== null) {
            $params['configName'] = $request->getConfigName();
        }
        if ($request->getOffset() !== null) {
            $params['offset'] = $request->getOffset();
        }
        if ($request->getSize() !== null) {
            $params['size'] = $request->getSize();
        }

        $resource = '/configs';
        [$resp, $header] = $this->send('GET', null, null, $resource, $params, $headers);
        $requestId = isset($header['x-log-requestid']) ? $header['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return new ListConfigsResponse($resp, $header);
    }

    public function createMachineGroup(CreateMachineGroupRequest $request)
    {
        $params = [];
        $headers = [];
        $body = null;
        if ($request->getMachineGroup() !== null) {
            $body = json_encode($request->getMachineGroup()->toArray());
        }
        $headers['Content-Type'] = 'application/json';
        $resource = '/machinegroups';
        [$resp, $header] = $this->send('POST', null, $body, $resource, $params, $headers);

        return new CreateMachineGroupResponse($header);
    }

    public function updateMachineGroup(UpdateMachineGroupRequest $request)
    {
        $params = [];
        $headers = [];
        $body = null;
        $groupName = '';
        if ($request->getMachineGroup() !== null) {
            $body = json_encode($request->getMachineGroup()->toArray());
            $groupName = ($request->getMachineGroup()->getGroupName() !== null) ? $request->getMachineGroup()->getGroupName() : '';
        }
        $headers['Content-Type'] = 'application/json';
        $resource = '/machinegroups/' . $groupName;
        [$resp, $header] = $this->send('PUT', null, $body, $resource, $params, $headers);
        return new UpdateMachineGroupResponse($header);
    }

    public function getMachineGroup(GetMachineGroupRequest $request)
    {
        $params = [];
        $headers = [];

        $groupName = ($request->getGroupName() !== null) ? $request->getGroupName() : '';

        $resource = '/machinegroups/' . $groupName;
        [$resp, $header] = $this->send('GET', null, null, $resource, $params, $headers);
        $requestId = isset($header['x-log-requestid']) ? $header['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return new GetMachineGroupResponse($resp, $header);
    }

    public function deleteMachineGroup(DeleteMachineGroupRequest $request)
    {
        $params = [];
        $headers = [];

        $groupName = ($request->getGroupName() !== null) ? $request->getGroupName() : '';
        $resource = '/machinegroups/' . $groupName;
        [$resp, $header] = $this->send('DELETE', null, null, $resource, $params, $headers);
        return new DeleteMachineGroupResponse($header);
    }

    public function listMachineGroups(ListMachineGroupsRequest $request)
    {
        $params = [];
        $headers = [];

        if ($request->getGroupName() !== null) {
            $params['groupName'] = $request->getGroupName();
        }
        if ($request->getOffset() !== null) {
            $params['offset'] = $request->getOffset();
        }
        if ($request->getSize() !== null) {
            $params['size'] = $request->getSize();
        }

        $resource = '/machinegroups';
        [$resp, $header] = $this->send('GET', null, null, $resource, $params, $headers);
        $requestId = isset($header['x-log-requestid']) ? $header['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);

        return new ListMachineGroupsResponse($resp, $header);
    }

    public function applyConfigToMachineGroup(ApplyConfigToMachineGroupRequest $request)
    {
        $params = [];
        $headers = [];
        $configName = $request->getConfigName();
        $groupName = $request->getGroupName();
        $headers['Content-Type'] = 'application/json';
        $resource = '/machinegroups/' . $groupName . '/configs/' . $configName;
        [$resp, $header] = $this->send('PUT', null, null, $resource, $params, $headers);
        return new ApplyConfigToMachineGroupResponse($header);
    }

    public function removeConfigFromMachineGroup(RemoveConfigFromMachineGroupRequest $request)
    {
        $params = [];
        $headers = [];
        $configName = $request->getConfigName();
        $groupName = $request->getGroupName();
        $headers['Content-Type'] = 'application/json';
        $resource = '/machinegroups/' . $groupName . '/configs/' . $configName;
        [$resp, $header] = $this->send('DELETE', null, null, $resource, $params, $headers);
        return new RemoveConfigFromMachineGroupResponse($header);
    }

    public function getMachine(GetMachineRequest $request)
    {
        $params = [];
        $headers = [];

        $uuid = ($request->getUuid() !== null) ? $request->getUuid() : '';

        $resource = '/machines/' . $uuid;
        [$resp, $header] = $this->send('GET', null, null, $resource, $params, $headers);
        $requestId = isset($header['x-log-requestid']) ? $header['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return new GetMachineResponse($resp, $header);
    }

    public function createACL(CreateACLRequest $request)
    {
        $params = [];
        $headers = [];
        $body = null;
        if ($request->getAcl() !== null) {
            $body = json_encode($request->getAcl()->toArray());
        }
        $headers['Content-Type'] = 'application/json';
        $resource = '/acls';
        [$resp, $header] = $this->send('POST', null, $body, $resource, $params, $headers);
        $requestId = isset($header['x-log-requestid']) ? $header['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return new CreateACLResponse($resp, $header);
    }

    public function updateACL(UpdateACLRequest $request)
    {
        $params = [];
        $headers = [];
        $body = null;
        $aclId = '';
        if ($request->getAcl() !== null) {
            $body = json_encode($request->getAcl()->toArray());
            $aclId = ($request->getAcl()->getAclId() !== null) ? $request->getAcl()->getAclId() : '';
        }
        $headers['Content-Type'] = 'application/json';
        $resource = '/acls/' . $aclId;
        [$resp, $header] = $this->send('PUT', null, $body, $resource, $params, $headers);
        return new UpdateACLResponse($header);
    }

    public function getACL(GetACLRequest $request)
    {
        $params = [];
        $headers = [];

        $aclId = ($request->getAclId() !== null) ? $request->getAclId() : '';

        $resource = '/acls/' . $aclId;
        [$resp, $header] = $this->send('GET', null, null, $resource, $params, $headers);
        $requestId = isset($header['x-log-requestid']) ? $header['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);

        return new GetACLResponse($resp, $header);
    }

    public function deleteACL(DeleteACLRequest $request)
    {
        $params = [];
        $headers = [];
        $aclId = ($request->getAclId() !== null) ? $request->getAclId() : '';
        $resource = '/acls/' . $aclId;
        [$resp, $header] = $this->send('DELETE', null, null, $resource, $params, $headers);
        return new DeleteACLResponse($header);
    }

    public function listACLs(ListACLsRequest $request)
    {
        $params = [];
        $headers = [];
        if ($request->getPrincipleId() !== null) {
            $params['principleId'] = $request->getPrincipleId();
        }
        if ($request->getOffset() !== null) {
            $params['offset'] = $request->getOffset();
        }
        if ($request->getSize() !== null) {
            $params['size'] = $request->getSize();
        }

        $resource = '/acls';
        [$resp, $header] = $this->send('GET', null, null, $resource, $params, $headers);
        $requestId = isset($header['x-log-requestid']) ? $header['x-log-requestid'] : '';
        $resp = $this->parseToJson($resp, $requestId);
        return new ListACLsResponse($resp, $header);
    }

    /**
     * GMT format time string.
     *
     * @return string
     */
    protected function getGMT()
    {
        return gmdate('D, d M Y H:i:s') . ' GMT';
    }

    /**
     * Decodes a JSON string to a JSON Object.
     * Unsuccessful decode will cause an AliYunLogException.
     *
     * @param mixed $resBody
     * @param mixed $requestId
     * @throws AliYunLogException
     * @return string
     */
    protected function parseToJson($resBody, $requestId)
    {
        if (! $resBody) {
            return null;
        }

        $result = json_decode($resBody, true);
        if ($result === null) {
            throw new AliYunLogException('BadResponse' . "Bad format,not json: {$resBody}" . $requestId);
        }
        return $result;
    }

    /**
     * @param mixed $method
     * @param mixed $url
     * @param mixed $body
     * @param mixed $headers
     * @return array
     */
    protected function getHttpResponse($method, $url, $body, $headers)
    {
        $request = new RequestCore($url);
        foreach ($headers as $key => $value) {
            $request->add_header($key, $value);
        }
        $request->set_method($method);
        $request->set_useragent(self::USER_AGENT);
        if ($method == 'POST' || $method == 'PUT') {
            $request->set_body($body);
        }
        $request->send_request();
        $response = [];
        $response[] = (int) $request->get_response_code();
        $response[] = $request->get_response_header();
        $response[] = $request->get_response_body();
        return $response;
    }

    private function setEndpoint($endpoint)
    {
        $pos = strpos($endpoint, '://');
        if ($pos !== false) { // be careful, !==
            $pos += 3;
            $endpoint = substr($endpoint, $pos);
        }
        $pos = strpos($endpoint, '/');
        if ($pos !== false) { // be careful, !==
            $endpoint = substr($endpoint, 0, $pos);
        }
        $pos = strpos($endpoint, ':');
        if ($pos !== false) { // be careful, !==
            $this->port = (int) substr($endpoint, $pos + 1);
            $endpoint = substr($endpoint, 0, $pos);
        } else {
            $this->port = 80;
        }
        $this->isRowIp = Util::isIp($endpoint);
        $this->logHost = $endpoint;
        $this->endpoint = $endpoint . ':' . (string) $this->port;
    }

    /**
     * @param mixed $method
     * @param mixed $url
     * @param mixed $body
     * @param mixed $headers
     * @throws AliYunLogException
     * @return array
     */
    private function sendRequest($method, $url, $body, $headers)
    {
        $response = $this->client->request($method, $url, [
            'headers' => $headers,
            'body' => $body,
        ]);
        $content =  $response->getBody()->getContents();
        return [$content, $response->getHeaders()];
    }

    /**
     * @param mixed $method
     * @param mixed $project
     * @param mixed $body
     * @param mixed $resource
     * @param mixed $params
     * @param mixed $headers
     * @throws AliYunLogException
     * @return array
     */
    private function send($method, $project, $body, $resource, $params, $headers)
    {
        if ($body) {
            $headers['Content-Length'] = strlen($body);
            if (isset($headers['x-log-bodyrawsize']) == false) {
                $headers['x-log-bodyrawsize'] = 0;
            }
            $headers['Content-MD5'] = Util::calMD5($body);
        } else {
            $headers['Content-Length'] = 0;
            $headers['x-log-bodyrawsize'] = 0;
            $headers['Content-Type'] = ''; // If not set, http request will add automatically.
        }

        $headers['x-log-apiversion'] = self::API_VERSION;
        $headers['x-log-signaturemethod'] = 'hmac-sha1';
        if (strlen($this->stsToken) > 0) {
            $headers['x-acs-security-token'] = $this->stsToken;
        }
        if (is_null($project)) {
            $headers['Host'] = $this->logHost;
        } else {
            $headers['Host'] = "{$project}.{$this->logHost}";
        }
        $headers['Date'] = $this->GetGMT();
        $signature = Util::getRequestAuthorization($method, $resource, $this->accessKey, $this->stsToken, $params, $headers);
        $headers['Authorization'] = "LOG {$this->accessKeyId}:{$signature}";

        $url = $resource;
        if ($params) {
            $url .= '?' . Util::urlEncode($params);
        }
        if ($this->isRowIp) {
            $url = "http://{$this->endpoint}{$url}";
        } else {
            if (is_null($project)) {
                $url = "http://{$this->endpoint}{$url}";
            } else {
                $url = "http://{$project}.{$this->endpoint}{$url}";
            }
        }
        return $this->sendRequest($method, $url, $body, $headers);
    }
}
