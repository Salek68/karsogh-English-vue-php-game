<?php

require __DIR__ . '/../vendor/autoload.php';

use YogeshKoli\UserIP\UserIP;

$ip = '192.168.10.1';

var_dump(UserIP::validate($ip));