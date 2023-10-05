<?php

namespace Util;

use Dao\UserDAOImpl;
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
        self::$connection?->close();
    }

    public static function runMigrations(): void
    {
        $connection = self::getConnection();
        // Check if the tables exist
        $usersExists = $connection->query("SHOW TABLES LIKE 'utenti'")->num_rows > 0;
        $eventsExists = $connection->query("SHOW TABLES LIKE 'eventi'")->num_rows > 0;

        $password1 = password_hash('Edusogno123', PASSWORD_DEFAULT);
        $password2 = password_hash('Edusogno?123', PASSWORD_DEFAULT);
        $password3 = password_hash('EdusognoCiao', PASSWORD_DEFAULT);
        $password4 = password_hash('EdusognoGia', PASSWORD_DEFAULT);
        if (!$usersExists || !$eventsExists) {
            $sqlScript = "
            CREATE TABLE IF NOT EXISTS utenti (
                id int NOT NULL AUTO_INCREMENT,
                nome varchar(45),
                cognome varchar(45),
                email varchar(255),
                password varchar(255),
                reset_token varchar(255),
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
                ('dgipolga@edume.me,ulysses200915@varen8.com,mavbafpcmq@hitbase.net', 'Test Edusogno 2', '2022-10-15 19:00'),
                ('john.doe@example.com,jane.smith@example.com', 'Event 96', '2023-04-15 10:00'),
                ('alice.johnson@example.com,bob.wilson@example.com', 'Event 12', '2023-05-20 14:30'),
                ('emily.brown@example.com,jane.smith@example.com', 'Event 11', '2023-06-10 19:15'),
                ('john.doe@example.com,alice.johnson@example.com', 'Event 14', '2023-07-08 16:45'),
                ('bob.wilson@example.com,emily.brown@example.com', 'Event 64', '2023-08-12 11:30'),
                ('jane.smith@example.com,john.doe@example.com', 'Event 9', '2023-09-05 15:00'),
                ('alice.johnson@example.com,bob.wilson@example.com', 'Event 30', '2023-10-20 17:30');
            
            INSERT INTO edusogno_db.utenti (nome, cognome, email, password)
            VALUES
                ('Marco', 'Rossi', 'ulysses200915@varen8.com', '$password1'),
                ('Filippo', 'D’Amelio', 'qmonkey14@falixiao.com', '$password2'),
                ('Gian Luca', 'Carta', 'mavbafpcmq@hitbase.net', '$password3'),
                ('Stella', 'De Grandis', 'dgipolga@edume.me', '$password4');
            ";

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
}