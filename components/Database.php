<?php

class Database {
    public static function getConnection() {
        $host = '127.0.0.1';
        $dbName = 'football_champ';
        $user = 'root';
        $password = 'root';

        return new PDO("mysql:host=$host;port=3306;charset=utf8;dbname=$dbName", $user, $password);
    }
}