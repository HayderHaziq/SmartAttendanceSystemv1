<?php
// app/Services/DatabaseService.php

namespace App\Services;

use PDO;
use PDOException;
use RuntimeException;
use TypeError;

class DatabaseService
{
    public static function initUnixDatabaseConnection(): PDO
    {
        try {
            $username = env('DB_USER');
            $password = env('DB_PASS');
            $dbName = env('DB_NAME');
            $instanceUnixSocket = env('INSTANCE_UNIX_SOCKET');

            // Connect using UNIX sockets
            $dsn = sprintf('mysql:dbname=%s;unix_socket=%s', $dbName, $instanceUnixSocket);

            // Connect to the database.
            $conn = new PDO(
                $dsn,
                $username,
                $password,
                # ... additional PDO options can be included here
            );
        } catch (TypeError $e) {
            throw new RuntimeException(
                // Handle TypeError
            );
        } catch (PDOException $e) {
            throw new RuntimeException(
                // Handle PDOException
            );
        }

        return $conn;
    }
}
