<?php
spl_autoload_register(function ($class) {
    // Remplace le namespace "App" par le chemin du dossier "src"
    $prefix = 'App\\';
    $baseDir = __DIR__ . '/../src/';

    // Vérifie si la classe utilise le namespace "App"
    if (strncmp($prefix, $class, strlen($prefix)) !== 0) {
        return; // Si ce n'est pas le cas, ne rien faire
    }

    // Convertit le namespace en chemin de fichier
    $relativeClass = substr($class, strlen($prefix));
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

    // Inclut le fichier s'il existe
    if (file_exists($file)) {
        require_once $file;
    }
});
