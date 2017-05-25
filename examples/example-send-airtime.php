<?php
require_once('src/autoload.php');

$oAirtime = new \CAMOO\Airtime\Airtime('592595095gh57', '4e32da5979879b89479847b9798479494984');

// receiver recipient
$oAirtime->destination_msisdn='237674911204';
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
