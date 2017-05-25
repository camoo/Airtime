<?php
require_once('src/autoload.php');

$oAirtime = new \CAMOO\Airtime\Airtime('592595095gh57', '4e32da5979879b89479847b9798479494984');
// set transaction Id
$oAirtime->id = '50';
var_dump($oAirtime->view());
