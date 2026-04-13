<?php

session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'httponly' => true,
    'samesite' => 'Lax'
]);

session_start();

$timeout = 1800; 


if (!empty($_SESSION['admin_logged_in'])) {
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout) {
        session_unset();
        session_destroy();

        header('Location: index.php?page=login');
        exit;
    }

    $_SESSION['last_activity'] = time();
}

// $baseUrl = '/HSF/';
$baseUrl = '/';
require_once 'includes/db.php';

$page = $_GET['page'] ?? 'home';

$allowedPages = [
    'home',
    'katalog',
    'detail',
    'admin_produkty',
    'produkt_pridat',
    'produkt_upravit',
    'produkt_zmazat',
    'produkt_aktivovat',
    'login',
    'logout',
    'onas',
    'kontakt',
    'realizacie',
    'zadanie',
    '404'
];

if (!in_array($page, $allowedPages, true)) {
    http_response_code(404);
    $page = '404';
}

if ($page === 'logout') {
    session_unset();
    session_destroy();
    header('Location: index.php?page=login');
    exit;
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

    case 'admin_produkty':
        include 'pages/admin_produkty.php';
        break;

    case 'produkt_pridat':
        include 'pages/produkt_pridat.php';
        break;

    case 'produkt_upravit':
        include 'pages/produkt_upravit.php';
        break;

    case 'produkt_zmazat':
        include 'pages/produkt_zmazat.php';
        break;

    case 'produkt_aktivovat':
        include 'pages/produkt_aktivovat.php';
        break;

    case 'login':
        include 'pages/login.php';
        break;

    case 'zadanie':
        include 'pages/zadanie.php';
        break;

    case '404':
    default:
        include 'pages/404.php';
        break;
}

include 'includes/footer.php';
?>