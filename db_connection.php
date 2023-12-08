<?php
// Чтение параметров подключения к базе данных из файла конфигурации
$ini = parse_ini_file('config/config.ini');

$host = $ini['host'];     
$login_db = $ini['login'];    
$password = $ini['password']; 
$name = $ini['name'];  

// Подключение к базе данных с использованием параметров из файла конфигурации
try {
   $mysql = new PDO("mysql:host=$host;dbname=$name;charset=utf8", "$login_db", "$password");
} catch (PDOException $e) {
    echo 'Подключение не удалось: ' . $e->getMessage();
}
?>
