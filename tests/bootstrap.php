<?php
/**
 * Copyright 2017 Camoo Sarl.
 *
 */

if (is_file('src/autoload.php')) {
    require_once 'src/autoload.php';
} else {
    require_once dirname(__DIR__) . '/src/autoload.php';
}