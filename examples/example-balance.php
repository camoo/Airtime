<?php
require_once('src/autoload.php');

$oBalance = new \CAMOO\Balance\Balance('592595095gh57', '4e32da5979879b89479847b9798479494984');

// get current CAMOO Balance
var_dump($oBalance->current());

// recharge account via MTN Mobile Money Cameroon
$hData = ['phonenumber' => '671234567', 'amount' => 1000];
var_dump($oBalance->add($hData));
