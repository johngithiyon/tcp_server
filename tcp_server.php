\<?php
$host = '127.0.0.1'; 
$port = 9000;        

$server = stream_socket_server("tcp://$host:$port", $errno, $errstr);

if (!$server) {
    die("Error: $errstr ($errno)\n");
}

echo "TCP server running on $host:$port...\n";


while ($client = stream_socket_accept($server)) {
    echo "Client connected.\n";

 
    $message = fread($client, 1024);
    echo "Received: " . $message . "\n";

    $response = "You said: " . trim($message) . "\n";
    fwrite($client, $response);

    fclose($client);
    echo "Client disconnected.\n";
}

fclose($server);
