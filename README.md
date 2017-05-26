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

Quick Examples

1) Get available general info about destination msisdn
```php
require_once('src/autoload.php');
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
