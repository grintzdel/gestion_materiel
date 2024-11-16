<?php
require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

define('DB_HOST', 'localhost');
define('DB_NAME', 'sae303');
define('DB_USER', 'root');
define('DB_PASSWORD', 'root');

//define('DB_HOST', getenv('DB_HOST'));
//define('DB_NAME', getenv('DB_NAME'));
//define('DB_USER', getenv('DB_USER'));
//define('DB_PASSWORD', getenv('DB_PASSWORD'));

var_dump(DB_HOST, DB_NAME, DB_USER, DB_PASSWORD);
$dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
var_dump($dsn);

try {
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';port=3306';
    $pdo = new PDO($dsn, DB_USER, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo 'Connexion réussie à la base de données !';
} catch (PDOException $e) {
    die('Erreur de connexion à la base de données ! ' . $e->getMessage());
}