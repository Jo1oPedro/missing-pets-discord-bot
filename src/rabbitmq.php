<?php

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

require_once __DIR__ . '/../vendor/autoload.php';

$connection = new AMQPStreamConnection('mensageria', '5672', 'cascata', 'shadow');
$channel = $connection->channel();
$channel->queue_declare('cadastroPost', false, true, false, false);
$channel->basic_consume('cadastroPost', callback: function (AMQPMessage $AMQPMessage) {
    var_dump($AMQPMessage->getBody());
    $AMQPMessage->ack();
});

try {
    $channel->consume();
} catch (Throwable $throwable) {
    var_dump($throwable);
}