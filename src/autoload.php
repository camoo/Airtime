<?php
/**
 * Copyright 2017 Camoo Sarl.
 *
 */
define('CAMOO_SRC_DIR', __DIR__.'/CAMOO/');
define('CAMOO_ROOT_SRC_DIR', dirname(__DIR__).'/');

if (version_compare(PHP_VERSION, '5.5.0', '<')) {
  throw new Exception('The CAMOO API requires PHP version 5.5 or higher.');
}

/**
 *
 * @param string $class The fully-qualified class name.
 * @return void
 */
spl_autoload_register(function ($class)
{
  // project-specific namespace prefix
  $prefix = 'CAMOO\\';

  // base directory for the namespace prefix
  $base_dir = defined('CAMOO_SRC_DIR') ? CAMOO_SRC_DIR : __DIR__ . '/CAMOO/';

  // does the class use the namespace prefix?
  $len = strlen($prefix);
  if (strncmp($prefix, $class, $len) !== 0) {
    // no, move to the next registered autoloader
    return;
  }

  // get the relative class name
  $relative_class = substr($class, $len);

  // replace the namespace prefix with the base directory, replace namespace
  // separators with directory separators in the relative class name, append
  // with .php
  $sFile = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

  // if the file exists, require it
  if ( file_exists($sFile) ) {
    require $sFile;
  }
});
