# Airtime
PHP API for Mobile phone TOPUP
[![N|Solid](https://www.camoo.cm/img/icon/camoo_logo_thom1.png)](https://www.camoo.cm/)

PHP TOPUP API via the **_CAMOO AIRTIME gateway_**

Requirement
-----------

This library needs minimum requirement for doing well on run.

   - [Sign up](https://www.camoo.cm/join) for a free CAMOO account
   - Ask CAMOO Team for new access_key for developers
   - CAMOO TOPUP API client for PHP requires version 5.5.x and above
   
## Installation via Composer

Package is available on [Packagist](https://packagist.org/packages/camoo/airtime),
you can install it using [Composer](http://getcomposer.org).

```shell
composer require camoo/airtime
```

Quick Examples

1) Get available general info about destination msisdn
```php
require_once dirname(dirname(dirname(__DIR__))) . '/autoload.php';
// set api_key and secret_key
$oAirtime = new \CAMOO\Airtime\Airtime('592595095gh57', '4e32da5979879b89479847b9798479494984');

// receiver recipient
$oAirtime->destination_msisdn='237671234567';
#Retrieve MsisdnInfo
$ohMsisdnInfo = $oAirtime->getMsisdnInfo();
```
2) Check available topup list and wholsale price list
```php
  $sTopupList = $ohMsisdnInfo->msisdn_info->topup_list;
  // your prices for each topup product
  $sWholeSalePriceList = $ohMsisdnInfo->msisdn_info->wholesale_price_list;
```
3) Choose a topup amount from the key topup_list and send airtime
```php
// airtime from
$oAirtime->msisdn= '237661562859';
// airtime product
$oAirtime->topup=100;
var_dump($oAirtime->send());
  ```
## Running Tests

Assuming you have PHPUnit installed system wide using one of the methods stated
[here](https://phpunit.de/manual/current/en/installation.html), you can run the
tests for CAMOO/Aitime by doing the following:

1. Go to library root `cd vendor/camoo/airtime`
2. Copy `phpunit.xml.dist` to `phpunit.xml`.
3. Run `phpunit tests`.
