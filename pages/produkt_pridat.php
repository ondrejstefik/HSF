
<?php
if (empty($_SESSION['admin_logged_in'])) {
    header('Location: index.php?page=login');
    exit;
}
?>
<?php
$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nazov = trim($_POST['nazov'] ?? '');
    $slug = trim($_POST['slug'] ?? '');
      if (empty($slug) && !empty($nazov)) {
      $slug = strtolower($nazov);
      $slug = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $slug);
      $slug = preg_replace('/[^a-z0-9]+/', '-', $slug);
      $slug = trim($slug, '-');
}
    $kategoria = trim($_POST['kategoria'] ?? '');
    $kratky_popis = trim($_POST['kratky_popis'] ?? '');
    $popis = trim($_POST['popis'] ?? '');
    $material = trim($_POST['material'] ?? '');
    $rozmery = trim($_POST['rozmery'] ?? '');
    $cena_od = (float)($_POST['cena_od'] ?? 0);
    $aktivny = isset($_POST['aktivny']) ? 1 : 0;

    $hlavny_obrazok = '';

    if (!empty($_FILES['hlavny_obrazok']['name'])) {
        $uploadDir = 'assets/images/produkty/';
        $originalName = basename($_FILES['hlavny_obrazok']['name']);
        $safeName = time() . '-' . preg_replace('/[^a-zA-Z0-9.\-_]/', '-', $originalName);
        $targetPath = $uploadDir . $safeName;

        if (move_uploaded_file($_FILES['hlavny_obrazok']['tmp_name'], $targetPath)) {
            $hlavny_obrazok = $safeName;
        } else {
            $error = 'Obrázok sa nepodarilo nahrať.';
        }
    }

    if (empty($nazov) || empty($slug) || empty($kategoria)) {
        $error = 'Vyplňte názov, slug a kategóriu.';
    }

    if (empty($error)) {
        $stmt = $conn->prepare("
            INSERT INTO produkty
            (nazov, slug, kategoria, kratky_popis, popis, material, rozmery, cena_od, hlavny_obrazok, aktivny)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");

        $stmt->bind_param(
           "sssssssdsi",
            $nazov,
            $slug,
            $kategoria,
            $kratky_popis,
            $popis,
            $material,
            $rozmery,
            $cena_od,
            $hlavny_obrazok,
            $aktivny
        );

        if ($stmt->execute()) {
            $success = 'Produkt bol úspešne pridaný.';

            $_POST = [];
        } else {
            $error = 'Pri ukladaní produktu nastala chyba.';
        }
    }
}
?>

<section class="page-hero">
    <div class="container">
        <h1>Pridať nový produkt</h1>
        <p>Vyplňte formulár a uložte nový produkt do katalógu.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <?php if (!empty($success)): ?>
            <p class="form-success"><?= htmlspecialchars($success) ?></p>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <p class="form-error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form action="index.php?page=produkt_pridat" method="post" enctype="multipart/form-data" class="admin-form">
            <p>
                <label for="nazov">Názov produktu *</label><br>
                <input type="text" id="nazov" name="nazov" required
                       value="<?= htmlspecialchars($_POST['nazov'] ?? '') ?>">
            </p>

            <p>
                <label for="slug">Slug (nepovinné, vytvorí sa automaticky)</label><br>
                <input type="text" id="slug" name="slug" 
                       value="<?= htmlspecialchars($_POST['slug'] ?? '') ?>">
            </p>

            <p>
                <?php
                $selectedKategoria = $produkt['kategoria'] ?? '';
                ?>
            <label for="kategoria">Kategória *</label><br>
            <select id="kategoria" name="kategoria" required>
                <option value="">-- Vyberte kategóriu --</option>
                <option value="stoly" <?= $selectedKategoria === 'stoly' ? 'selected' : '' ?>>Stoly</option>
                <option value="postele" <?= $selectedKategoria === 'postele' ? 'selected' : '' ?>>Postele</option>
                <option value="komody" <?= $selectedKategoria === 'komody' ? 'selected' : '' ?>>Komody</option>
                <option value="skrine" <?= $selectedKategoria === 'skrine' ? 'selected' : '' ?>>Skrine</option>
                <option value="nocne-stoliky" <?= $selectedKategoria === 'nocne-stoliky' ? 'selected' : '' ?>>Nočné stolíky</option>
                <option value="vesiaky" <?= $selectedKategoria === 'vesiaky' ? 'selected' : '' ?>>Vešiaky</option>
                <option value="ostatne" <?= $selectedKategoria === 'ostatne' ? 'selected' : '' ?>>Ostatné</option>
            </select>
            </p>

            <p>
                <label for="kratky_popis">Krátky popis</label><br>
                <textarea id="kratky_popis" name="kratky_popis" rows="3"><?= htmlspecialchars($_POST['kratky_popis'] ?? '') ?></textarea>
            </p>

            <p>
                <label for="popis">Popis</label><br>
                <textarea id="popis" name="popis" rows="6"><?= htmlspecialchars($_POST['popis'] ?? '') ?></textarea>
            </p>

            <p>
                <label for="material">Materiál</label><br>
                <input type="text" id="material" name="material"
                       value="<?= htmlspecialchars($_POST['material'] ?? '') ?>">
            </p>

            <p>
                <label for="rozmery">Rozmery</label><br>
                <input type="text" id="rozmery" name="rozmery"
                       value="<?= htmlspecialchars($_POST['rozmery'] ?? '') ?>">
            </p>

            <p>
                <label for="cena_od">Cena od</label><br>
                <input type="number" id="cena_od" name="cena_od" step="0.01"
                       value="<?= htmlspecialchars($_POST['cena_od'] ?? '') ?>">
            </p>

            <p>
                <label for="hlavny_obrazok">Hlavný obrázok</label><br>
                <input type="file" id="hlavny_obrazok" name="hlavny_obrazok" accept=".jpg,.jpeg,.png,.webp">
            </p>

            <p>
                <label>
                    <input type="checkbox" name="aktivny" <?= isset($_POST['aktivny']) || !$_POST ? 'checked' : '' ?>>
                    Aktívny produkt
                </label>
            </p>

            <p>
                <button type="submit" class="btn">Uložiť produkt</button>
                <a href="index.php?page=admin_produkty" class="btn btn-secondary">Späť na správu produktov</a>
            </p>
        </form>
    </div>
</section>