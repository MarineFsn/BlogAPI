<?php
include 'config/router.php';

ini_set('display_errors', 'off');
ini_set('log_errors', 'on');
ini_set('error_log','error.log');


$router->run();
