#!/usr/bin/env php
<?php
define('PHPUnit_MAIN_METHOD', '\lib\Loader::main()');
$files = array(
	__DIR__ . '/../vendor/autoload.php'
);

foreach ($files as $file) {
	if (file_exists($file)) {
		require_once $file;

		define('PHPUNIT_COMPOSER_INSTALL', $file);

		break;
	}
}

if (!defined('PHPUNIT_COMPOSER_INSTALL')) {
	die(
		'You need to set up the project dependencies using the following commands:' . PHP_EOL .
		'curl -s http://getcomposer.org/installer | php' . PHP_EOL .
		'php composer.phar install' . PHP_EOL
	);
}

\lib\Loader::main();