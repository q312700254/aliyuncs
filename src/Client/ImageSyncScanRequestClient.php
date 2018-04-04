<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Author: 6169
 * Date: 2018\4\4 0004
 * Time: 11:03
 */
namespace AliyunCs\Client;


use AliyunCs\Client\RequestClient;
use AliyunCs\Core\DefaultAcsClient;
use AliyunCs\Core\Profile\DefaultProfile;
use AliyunCs\Request\ImageSyncScanRequest;

class ImageSyncScanRequestClient extends RequestClient
{
    public function request($accessKey, $secretKey)
    {
        $iClientProfile = DefaultProfile::getProfile("cn-shanghai", $accessKey, $secretKey);

        DefaultProfile::addEndpoint("cn-shanghai", "cn-shanghai", "Green", "green.cn-shanghai.aliyuncs.com");
        $client = new DefaultAcsClient($iClientProfile);
        $request = new ImageSyncScanRequest();
        $request->setMethod("POST");
        $request->setAcceptFormat("JSON");
        $task1 = array('dataId' =>  uniqid(),
            'url' => 'https://ss0.baidu.com/73x1bjeh1BF3odCf/it/u=3926533069,3647298623&fm=85&s=8AA8408542027CFA88A0C5FB03009033',
            'time' => round(microtime(true)*1000)
        );
        $request->setContent(json_encode(array("tasks" => array($task1),
            "scenes" => array("porn", 'terrorism', 'live'))));
        echo '<pre/>';
        try {
            $response = $client->getAcsResponse($request);
            print_r($response);
            if(200 == $response->code){
                $taskResults = $response->data;
                foreach ($taskResults as $taskResult) {
                    if(200 == $taskResult->code){
                        $sceneResults = $taskResult->results;
                        foreach ($sceneResults as $sceneResult) {
                            $scene = $sceneResult->scene;
                            $suggestion = $sceneResult->suggestion;
                            //根据scene和suggetion做相关的处理
                            //do something
                            print_r($scene);
                            print_r($suggestion);
                        }
                    }else{
                        print_r("task process fail:" + $response->code);
                    }
                }
            }else{
                print_r("detect not success. code:" + $response->code);
            }
        } catch (Exception $e) {
            print_r($e);
        }

        exit();
    }
}