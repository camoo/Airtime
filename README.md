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

1) Sending a Airtime
```php
   require_once('src/autoload.php');

$oAirtime = new \CAMOO\Airtime\Airtime('592595095gh57', '4e32da5979879b89479847b9798479494984');

// receiver recipient
$oAirtime->destination_msisdn='237671234567';
// airtime from
$oAirtime->msisdn= '237661562859';
// airtime product
$oAirtime->topup=100;
// just to test
//$oAirtime->test_mode=true;
$oAirtime->send_sms=true;
// set developer custom message
$oAirtime->sms='YourCompany Best Topup Service'; // max length 30 chars
var_dump($oAirtime->send());
  ```
