<?php
require_once('src/autoload.php');

$oAirtime = new \CAMOO\Airtime\Airtime('592595095gh57', '4e32da5979879b89479847b9798479494984');
// receiver recipient
$oAirtime->destination_msisdn='237671234567';
#Retrieve retail price list
var_dump($oAirtime->getRetailPriceList());
