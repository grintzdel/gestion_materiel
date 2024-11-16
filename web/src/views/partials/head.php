<?php
$current_page = basename($_SERVER['PHP_SELF']);
$beforeLink = '../../';
if ($current_page === 'index.php') {
    $beforeLink = 'src/';
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?= $beforeLink . 'public/style.css' ?>">
    <title>MMMI Chambéry</title>
</head>
<body>

<?php require_once 'header.php'; ?>

<main>

