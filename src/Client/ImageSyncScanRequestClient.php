<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Author: 6169
 * Date: 2018\4\4 0004
 * Time: 11:03
 */
namespace AliyunCs\Client;


use AliyunCs\Core\DefaultAcsClient;
use AliyunCs\Core\Profile\DefaultProfile;
use AliyunCs\Request\ImageSyncScanRequest;
use AliyunCs\Core\Exception\ClientException;

class ImageSyncScanRequestClient extends RequestClient
{
    public function request($imageUrl, array $scenes)
    {
        $iClientProfile = DefaultProfile::getProfile("cn-shanghai", $this->accessKey, $this->secretKey);
        DefaultProfile::addEndpoint("cn-shanghai", "cn-shanghai", "Green", "green.cn-shanghai.aliyuncs.com");
        $client = new DefaultAcsClient($iClientProfile);
        $request = new ImageSyncScanRequest();
        $this->parseTasksContent($request, $imageUrl, $scenes);
        try {
            $this->response = $client->getAcsResponse($request);
            $sceneReturns = [];
            foreach ($this->response() as $sceneResult) {
                $sceneReturns[$sceneResult->scene] = $sceneResult->suggestion;
            }
            return $sceneReturns;
        } catch (Exception $e) {
            throw new ClientException('detect not success. code:' + $this->response->code, $this->response->code);
        }
    }

    public function parseTasksContent(ImageSyncScanRequest &$request, &$imageUrl, array &$scenes)
    {
        $request->setMethod("POST");
        $request->setAcceptFormat("JSON");
        (is_array($imageUrl)) || $imageUrl = [$imageUrl];
        $tasks = [];
        foreach ($imageUrl as $key => $val) {
            $tasks[] = [
                'dataId' => uniqid(),
                'url'    => $val,
                'time'   => round(microtime(true) * 1000)
            ];
        }
        $request->setContent(json_encode([
            'tasks' => $tasks,
            'scenes'=> $scenes,
        ]));
    }

    public function response()
    {
        if(200 == $this->response->code){
            $taskResults = $this->response->data;
            foreach ($taskResults as $taskResult) {
                if(200 == $taskResult->code){
                    return $taskResult->results;
                }
            }
        }

        throw new ClientException('detect not success. code:' + $this->response->code, $this->response->code);
    }
}