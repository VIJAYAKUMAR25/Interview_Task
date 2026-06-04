<?php
$host = 'localhost';
$dbname = 'wpoets_test';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host", $user, $pass);
    // Create DB if not exists
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname`;");
    $pdo->exec("USE `$dbname`;");
    // Create table if not exists
    $pdo->exec("CREATE TABLE IF NOT EXISTS slides (
        id INT AUTO_INCREMENT PRIMARY KEY,
        tab_name VARCHAR(255) NOT NULL,
        tab_icon_path VARCHAR(255) NOT NULL,
        category VARCHAR(255) NOT NULL,
        title VARCHAR(255) NOT NULL,
        link VARCHAR(255) NOT NULL,
        image_path VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );");
    // Check if table is empty and seed if necessary
    $stmt = $pdo->query("SELECT COUNT(*) FROM slides");
    if ($stmt->fetchColumn() == 0) {
        $pdo->exec("INSERT INTO slides (tab_name, tab_icon_path, category, title, link, image_path) VALUES 
        ('Learning', 'files/images/DL-learning.svg', 'DIGITAL LEARNING INFRASTRUCTURE', 'Usability enhancement and Training for Transaction Portal for Customers', '#', 'files/images/DL-Learning-1.jpg'),
        ('Technology', 'files/images/DL-technology.svg', 'TECHNOLOGY ENABLEMENT', 'Seamless integration of disparate systems for unified workflow', '#', 'files/images/DL-Technology.jpg'),
        ('Communication', 'files/images/DL-communication.svg', 'STRATEGIC COMMUNICATION', 'Enhancing corporate communication through robust digital platforms', '#', 'files/images/DL-Communication.jpg')");
    }

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
