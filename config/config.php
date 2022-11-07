<?php

require_once 'dotenv.php';
(new DotEnv(__DIR__ .'/.env'))->load(); 

define('BASEURL', getenv('BASEURL'));
define('DB_HOST', getenv('DB_HOST'));
define('DB_USER', getenv('DB_USER'));
define('DB_PASSWORD', getenv('DB_PASSWORD'));
define('DB_NAME', getenv('DB_NAME'));