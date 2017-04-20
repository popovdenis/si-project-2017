<?php
$config = parse_ini_file('config.ini', true);

// define site domain
define('SITE', $config['domain']);
define('BASE_PATH', realpath(__DIR__));

// define menu options
define('DASHBOARD', 'dashboard');
define('MULTI', 'multi');
define('CALC', 'calc');
define('QUIZ', 'quiz');
define('USERS', 'users');
define('LOGIN', 'login');

// define DB configuration
$configDb = $config['db'];
define('DB_HOST', $configDb['host']);
define('DB_USER', $configDb['user']);
define('DB_PASSWORD', $configDb['password']);
define('DB_NAME', $configDb['dbname']);
define('DB_PORT', $configDb['port']);

// define quiz configuration
$configQuiz = $config['quiz'];
define('QUIZ_LIMIT', $configQuiz['limit']);
