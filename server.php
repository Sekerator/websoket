<?php
//var_dump($_POST);
$localsocket = 'tcp://127.0.0.1:1234';
$message = json_encode($_GET);

// соединяемся с локальным tcp-сервером
$instance = stream_socket_client($localsocket);

// отправляем сообщение
fwrite($instance, $message  . "\n");
