<?php
require_once (__DIR__ . '/../vendor/autoload.php');

$config = require (__DIR__ . '/../config/config.php');

$app = new \app\App($config);

$app->send();