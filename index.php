<?php
$baseUrl = '/HSF/';
require_once 'includes/db.php';

$page = $_GET['page'] ?? 'home';

$allowedPages = ['home', 'katalog', 'detail', 'onas', 'kontakt', 'realizacie', '404'];

if (!in_array($page, $allowedPages, true)) {
    http_response_code(404);
    $page = '404';
}

include 'includes/header.php';
include 'includes/nav.php';

switch ($page) {

    case 'home':
        include 'pages/home.php';
        break;

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

   case '404':
   default:
        include 'pages/404.php';
        break;
}

include 'includes/footer.php';
?>