<?php
header("Access-Control-Allow-Origin: http://localhost:80");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// session
ini_set('session.cookie_lifetime', 60*60*24*7); // sec * min * hours * days
session_start();

require_once __DIR__ . '/autoLoader/autoLoader.php';
require_once __DIR__ . '/routes/router.php';
