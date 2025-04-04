<?php
try {
    // Your actual PostgreSQL Render credentials
    $host = 'dpg-cvnjpqh5pdvs73b8mba0-a';     // internal hostname
    $port = '5432';
    $dbname = 'helpingos_db';
    $user = 'helpingos_db_user';
    $pass = 'eFXy21i9xkyb3NuZY4pwO8W4EChlJZsB';

    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";

    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
