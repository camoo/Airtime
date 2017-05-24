<?php
require_once('src/autoload.php');

$oAirtime = new \CAMOO\Airtime\Airtime('592595095gh57', '4e32da5979879b89479847b9798479494984');

// receiver recipient
$oAirtime->destination_msisdn='237671234567';
// airtime from
$oAirtime->msisdn='237340404';
// airtime amount
$oAirtime->topup=100;
// just to test
$oAirtime->test_mode=true;
/*
$oAirtime->send_sms=true;
$oAirtime->sms='Developer own custom message';
$oAirtime->sender_sms=true;
$oAirtime->sender_text='Customer own custom message';
*/

#Retrieve TopUp option for a phone number 
//var_dump($oAirtime->getTopupList());

#Retrieve MsisdnInfo
//var_dump($oAirtime->getMsisdnInfo());

#retrieve WholeSalePriceList
//var_dump($oAirtime->getWholeSalePriceList());

#Retrieve retail price list
//var_dump($oAirtime->getRetailPriceList());

var_dump($oAirtime->send());
