<?php
$pageTitles = [
    'home' => 'HSF | Ručne robený slovenský nábytok',
    'katalog' => 'HSF | Katalóg nábytku',
    'detail' => 'HSF | Detail produktu',
    'onas' => 'HSF | O nás',
    'kontakt' => 'HSF | Kontakt',
    'realizacie' => 'HSF | Realizácie'
];

$currentTitle = $pageTitles[$page] ?? 'HSF';
?>
<!DOCTYPE html>
<html lang="sk">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($currentTitle) ?></title>
    <meta name="description" content="HSF - internetový katalóg ručne robeného slovenského nábytku z masívu.">
    <link rel="stylesheet" href="<?= $baseUrl ?>assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>

<header class="site-header">
    <div class="container header-inner">
        <a href="index.php?page=home" class="logo" aria-label="HSF - Handmade Slovak Furniture">
            <img src="assets/images/logo_full_web.webp" alt="HSF - Handmade Slovak Furniture">
        </a>
         <div class="header-info">
            <h1>HSF - Handmade Slovak Furniture</h1>
            <h2>Výroba na mieru • Masívne drevo • Výber moridla</h2>
            <p class="header-date">Dátum:<strong> <?= date('d.m.Y') ?></strong></p>
        </div>
        <div class="header-badge" aria-hidden="true">
            <img src="assets/images/peciatka_handmade.webp" alt="">
        </div>

       
    </div>
</header>