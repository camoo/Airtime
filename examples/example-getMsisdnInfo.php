<?php
require_once('src/autoload.php');

$oAirtime = new \CAMOO\Airtime\Airtime('592595095gh57', '4e32da5979879b89479847b9798479494984');

$oAirtime->destination_msisdn='237671234567';
$oAirtime->topup=1500;
$oAirtime->msisdn='237340404';
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
