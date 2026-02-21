<?php
try {
    $dsn = "mysql:host=127.0.0.1;port=3306;dbname=carrer_link";
    $user = "root";
    $password = "";
    $pdo = new PDO($dsn, $user, $password);
    echo "Connection successful!\n";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage() . "\n";
}
?>
