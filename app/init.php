<?php
// error logging
error_reporting(E_ALL);
ini_set('ignore_repeated_errors', TRUE);
ini_set('display_errors', TRUE);
ini_set('log_errors', TRUE);
ini_set('error_log', '../app/tmp/errors.log');

require_once 'core/App.php';
require_once 'core/Controller.php';
