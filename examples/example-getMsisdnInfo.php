<?php
require_once('src/autoload.php');

$oClient = new \CAMOO\Airtime\Airtime('592595095gh57', '4e32da5979879b89479847b9798479494984');

// Retrieve TopUp option for a phone number 
var_dump($oClient->getMsisdnInfo(237671234567));
