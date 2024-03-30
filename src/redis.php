<?php

ini_set('default_socket_timeout', -1);

$redis = new Redis();

$connection = $redis->connect('redis', '6379');

if($connection) {
    echo 'conseguiu conectar' . PHP_EOL;
}

$redis->subscribe(['missingpets_database_publish'], function ($redis, $channel, $message) {
    echo $message . ' cascata123' .PHP_EOL;
});