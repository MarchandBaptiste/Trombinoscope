<?php
function db()
{
    try {
        $user = "root";
        $pwd = "";
        $dbname = "trombinoscope_db";
        $dsn = "mysql:host=localhost:3306;dbname=" . $dbname . ";charset=utf8";
        $db = new PDO($dsn, $user, $pwd, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
        return $db;
    } catch (PDOException $error) {
        var_dump($error);
        die;
    }
}
