<?php
$baseUrl = '/HSF/';
require_once 'includes/db.php';

$page = $_GET['page'] ?? 'home';

$allowedPages = ['home', 'katalog', 'detail', 'onas', 'kontakt', 'realizacie'];

if (!in_array($page, $allowedPages, true)) {
    $page = 'home';
}

include 'includes/header.php';
include 'includes/nav.php';

switch ($page) {
    case 'katalog':
        include 'pages/katalog.php';
        break;

    case 'detail':
        include 'pages/detail.php';
        break;

    case 'onas':
        include 'pages/onas.php';
        break;

    case 'kontakt':
        include 'pages/kontakt.php';
        break;

    case 'realizacie':
        include 'pages/realizacie.php';
        break;

    default:
        include 'pages/home.php';
        break;
}

include 'includes/footer.php';
?>