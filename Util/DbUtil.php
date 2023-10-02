<?php

namespace Util;

use mysqli;

class DbUtil
{
    private static string $host = 'localhost';
    private static string $username = 'root';
    private static string $password = 'root';
    private static string $database = 'edusogno_db';
    private static ?mysqli $connection = null;

    private static function connect(): void
    {
        if (self::$connection === null) {
            try {
                self::$connection = new mysqli(self::$host, self::$username, self::$password, self::$database);
            } catch (\Exception $e) {
                echo $e;
            }
        }
    }

    public static function getConnection(): mysqli
    {
        self::connect();
        return self::$connection;
    }

    public static function closeConnection(): void
    {
        if (self::$connection) {
            self::$connection->close();
        }
    }

    public static function runMigrations(): void
    {
        $connection = self::getConnection();
        $sqlScript = "CREATE TABLE IF NOT EXISTS utenti (
                        id int NOT NULL AUTO_INCREMENT,
                        nome varchar(45),
                        cognome varchar(45),
                        email varchar(255),
                        password varchar(255),
                        PRIMARY KEY (id)
                        );

                        CREATE TABLE IF NOT EXISTS eventi (
                        id int NOT NULL AUTO_INCREMENT,
                        attendees text,
                        nome_evento varchar(255),
                        data_evento datetime,
                        PRIMARY KEY (id)
                        );

                        INSERT INTO `eventi` (`attendees`, `nome_evento`, `data_evento`)
                        VALUES
                            ('ulysses200915@varen8.com,qmonkey14@falixiao.com,mavbafpcmq@hitbase.net', 'Test Edusogno 1', '2022-10-13 14:00'),
                            ('dgipolga@edume.me,qmonkey14@falixiao.com,mavbafpcmq@hitbase.net', 'Test Edusogno 2', '2022-10-15 19:00'),
                            ('dgipolga@edume.me,ulysses200915@varen8.com,mavbafpcmq@hitbase.net', 'Test Edusogno 2', '2022-10-15 19:00');";

        // Split the SQL script into individual queries
        $queries = explode(';', $sqlScript);
        foreach ($queries as $query) {
            $query = trim($query);
            if (!empty($query)) {
                $connection->query($query);
            }
        }
        self::closeConnection();
    }
}