<?php
// server.php

$host = 'localhost';
$port = 8000;

echo "Server running on http://$host:$port\n";

exec("php -S $host:$port -t ". __DIR__);
