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
namespace HyperfTest\Stub;

use GuzzleHttp\Client;
use Hyperf\Config\Config;
use Hyperf\Contract\ConfigInterface;
use Hyperf\Contract\ContainerInterface;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\Di\Container;
use Hyperf\Guzzle\ClientFactory;
use Hyperf\Utils\ApplicationContext;
use Mockery;

class ContainerStub
{
    /**
     * @return ContainerInterface
     */
    public static function getContainer()
    {
        $container = Mockery::mock(Container::class);
        ApplicationContext::setContainer($container);

        $container->shouldReceive('get')->with(StdoutLoggerInterface::class)->andReturnUsing(function () {
            $logger = Mockery::mock(StdoutLoggerInterface::class);
            $logger->shouldReceive('debug')->andReturn(null);
            return $logger;
        });

//        $container->shouldReceive('make')->with(Client::class)->andReturn(new Client());

        $container->shouldReceive('get')->with(ClientFactory::class)->andReturn(new ClientFactory($container));
        $container->shouldReceive('make')->with(Client::class)->andReturn(new Client(['config' => '']));

        $container->shouldReceive('get')->with(ConfigInterface::class)->andReturn(new Config([
            'aliyun-sls-log' => [
                'default' => [
                    'endpoint' => '',
                    'access_key_id' => '',
                    'access_key' => '',
                    'project' => '',
                    'logstore' => '',
                    'token' => '',
                ],
            ],
        ]));

        return $container;
    }
}
