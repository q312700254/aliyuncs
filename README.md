Aliyuncs for php 
--------------------------------


## Contents
- [Installation](#installation)
- [Example](#example)

## Installation

With composer

```bash
composer require llwch/aliyuncs
```

Or add

```json
"llwch/aliyuncs": "dev-master"
```

to your composer.json. Then run `composer install` or `composer update`.

## example

An example of how to used:

```php
<?php

use AliyunCs\Client\ImageSyncScanRequestClient;

class ImageSyncScan
{
    public function handle()
    {
        $accessKey = 'xxxxxxxxxxxxx';
        $secretKey = 'xxxxxxxxxxxxx';
        $handleImg = 'http://www.xxxx.com/xxx.jpg';
        $handleImg = [
            'http://www.xxxx.com/xxx.jpg',
            'http://www.xxxx.com/xxx.jpg'
        ];
        $imageSyncScanResults = (new ImageSyncScanRequestClient($accessKey, $secretKey))->request($handleImg);
        
        //TODO;
    }
}
```