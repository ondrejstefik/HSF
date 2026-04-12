<?php
if (empty($_SESSION['admin_logged_in'])) {
    header('Location: index.php?page=login');
    exit;
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    header('Location: index.php?page=admin_produkty');
    exit;
}

/* Najprv zistíme obrázok produktu */
$stmt = $conn->prepare("SELECT hlavny_obrazok FROM produkty WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$produkt = $result->fetch_assoc();

if (!$produkt) {
    header('Location: index.php?page=admin_produkty');
    exit;
}

$obrazok = $produkt['hlavny_obrazok'] ?? '';

/* Vymažeme produkt z databázy */
$stmt = $conn->prepare("DELETE FROM produkty WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    /* Ak existuje obrázok, skúsime ho zmazať aj zo servera */
    if (!empty($obrazok)) {
        $imagePath = __DIR__ . '/../assets/images/produkty/' . $obrazok;

        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    header('Location: index.php?page=admin_produkty');
    exit;
} else {
    echo '<section class="section"><div class="container"><p>Produkt sa nepodarilo vymazať.</p></div></section>';
}
?>