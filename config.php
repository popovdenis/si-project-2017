<?php
$config = parse_ini_file('config.ini', true);

define('SITE', $config['domain']);

define('DASHBOARD', 'dashboard');
define('MULTI', 'multi');
define('CALC', 'calc');
define('QUIZ', 'quiz');
define('USERS', 'users');

//$configDb = $config['db'];
//define('DB_HOST', $configDb['host']);
//define('DB_USER', $configDb['user']);
//define('DB_PASSWORD', $configDb['password']);
//define('DB_NAME', $configDb['dbname']);
//define('DB_PORT', $configDb['port']);
