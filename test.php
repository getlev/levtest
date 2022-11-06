<?php

/**
 * Builds Lev distr from given Grav installation
 * Replaces all [`grav` => `lev`] strings in Grav file names and contents
 *
 * To upgrade Grav to the recent version run in a Grav root dir:
 * 		php bin/gpm selfupgrade
 */

use Lev\Maker\LogLevMaker;
use Micro\Error\ErrorHandler;

require 'D:/LocalHost/vsd.loc/micro/src/Micro/Error/ErrorHandler.php';
new ErrorHandler();

require 'D:/LocalHost/vsd.loc/micro/src/Micro/Helpers/psr4autoloader.php';
psr4AutoloadRegister(['Lev' => __DIR__ . '/maker/src/Lev']);

for ($i = 0; $i < ob_get_level(); $i++) { ob_end_flush(); }	// Flush output buffers
ob_implicit_flush(true);	// set implicit flushing for each `echo` output
set_time_limit(300);		//300 seconds = 5 minutes (average run is ~1 min)

//********************************************************************
// Convert Grav to Lev
//********************************************************************

$gravDir = __DIR__ . '/../grav-admin-v1.7.35';
// $gravDir = __DIR__ . '/../grav36';
// $levDir	 = __DIR__ . '/../lev36';
$levDir	 = __DIR__ . '/../../test.loc';
$makeDir = __DIR__ . '/maker';

$log = new LogLevMaker($gravDir, $levDir, $makeDir);
$log->logParts([
	'check',
	'clear',
	'system',
	'src',
	'bin',
	'plugins',
	'themes',
	'vendor',
	'demos',
]);

echo $log->dump();
de($log->maker);
