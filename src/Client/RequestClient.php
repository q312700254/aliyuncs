<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Author: 6169
 * Date: 2018\4\4 0004
 * Time: 11:05
 */
namespace AliyunCs\Client;

use AliyunCs\Core\Regions\EndpointProvider;

abstract class RequestClient
{
    public function __construct()
    {
        $this->defineVar();
        $this->setEndpoints();
    }

    public function defineVar()
    {
        defined('LOCATION_SERVICE_PRODUCT_NAME') or define("LOCATION_SERVICE_PRODUCT_NAME", "Location");
        defined('LOCATION_SERVICE_DOMAIN') or define("LOCATION_SERVICE_DOMAIN", "location.aliyuncs.com");
        defined('LOCATION_SERVICE_VERSION') or define("LOCATION_SERVICE_VERSION", "2015-06-12");
        defined('LOCATION_SERVICE_DESCRIBE_ENDPOINT_ACTION') or define("LOCATION_SERVICE_DESCRIBE_ENDPOINT_ACTION", "DescribeEndpoints");
        defined('LOCATION_SERVICE_REGION') or define("LOCATION_SERVICE_REGION", "cn-hangzhou");
        defined('CACHE_EXPIRE_TIME') or define("CACHE_EXPIRE_TIME", 3600);

        //config http proxy
        defined('ENABLE_HTTP_PROXY') or define('ENABLE_HTTP_PROXY', false);
        defined('HTTP_PROXY_IP') or define('HTTP_PROXY_IP', '127.0.0.1');
        defined('HTTP_PROXY_PORT') or define('HTTP_PROXY_PORT', '8888');

    }

    public function setEndpoints()
    {
        EndpointProvider::setEndpoints(EndpointProvider::parseEndpoints());
    }
}