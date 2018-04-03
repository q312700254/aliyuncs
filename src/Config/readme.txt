新增特性:
一. 关键词过滤服务和文本垃圾检测支持关键词自定义: 关键词自定义请前往绿网控制台进行添加(https://yundun.console.aliyun.com/?p=cts#/greenWeb/config2), 添加的关键词默认自动生效
二. 新增图片牛皮鲜广告识别

1. 依赖的库在本工程 aliyuncs目录下, 包括两个库:
   aliyun-php-sdk-core
   aliyun-php-sdk-green(V2017011206)

下载地址:
https://github.com/aliyun/aliyun-openapi-php-sdk?spm=5176.1970889.104.1.IZLYqn

2.本样例提供一下接口的调用示例:
  a. 图片异步检测接口: ImageAsyncScanRequestSample
  b. 获取图片异步检测结果接口:ImageAsyncScanResultsSample
  c. 图片同步检测接口:ImageSyncScanRequestSample
  d. 文本检测接口:TextScanSample
  e. 视频异步检测接口:VideoAsyncScanRequestSample
  f. 获取视频异步检测结果接口:VideoAsyncScanResultsSample

3. 用户请参照样例里面的代码注释描述

4. 几点解释说明
    a. 异步图片检测不会实时返回服务的处理结果，每张图片将以任务的形式在服务端处理，所以会分配调用后图片的taskid，在一定时间内通过taskid来获取处理结果
    b. 同步图片检测将会实时返回服务的处理结果
