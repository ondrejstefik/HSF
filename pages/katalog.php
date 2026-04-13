<section class="page-hero katalog-hero"> 
    <div class="container hero-content">
        <h2>Katalóg nábytku</h2>
        <p>Vyberte si z našej ponuky ručne vyrábaného nábytku z masívu.</p>
    </div>
</section>

<?php
$sort = $_GET['sort'] ?? 'nazov_asc';
$filter = $_GET['kategoria'] ?? 'vsetko';

$allowedSorts = [
    'nazov_asc' => 'nazov ASC',
    'nazov_desc' => 'nazov DESC',
    'kategoria_asc' => 'kategoria ASC',
    'kategoria_desc' => 'kategoria DESC',
    'cena_asc' => 'cena_od ASC',
    'cena_desc' => 'cena_od DESC',
];

$allowedCategories = [
    'vsetko' => null,
    'Stoly' => 'Stoly',
    'Stolíky' => 'Stolíky',
    'Komody' => 'Komody',
    'Nočné stolíky' => 'Nočné stolíky',
    'Lavice' => 'Lavice',
    'Police' => 'Police',
    'Postele' => 'Postele'
];

$orderBy = $allowedSorts[$sort] ?? 'nazov ASC';
$selectedCategory = $allowedCategories[$filter] ?? null;

$sql = "SELECT id, nazov, kategoria, kratky_popis, material, cena_od, hlavny_obrazok 
        FROM produkty 
        WHERE aktivny = 1";

if ($selectedCategory !== null) {
    $safeCategory = $conn->real_escape_string($selectedCategory);
    $sql .= " AND kategoria = '$safeCategory'";
}

$sql .= " ORDER BY $orderBy";

$result = $conn->query($sql);
?>

<section class="section">
    <div class="container">
        <h2>Filtrovanie a zoznam produktov</h2>
        <form method="GET" class="sort-form" style="margin-bottom: 20px; display: flex; gap: 15px; flex-wrap: wrap; align-items: center;">
            <input type="hidden" name="page" value="katalog">

            <div>
                <label for="kategoria"><strong>Filtrovať podľa kategórie:</strong></label>
                <select name="kategoria" id="kategoria" onchange="this.form.submit()">
                    <option value="vsetko" <?= $filter === 'vsetko' ? 'selected' : '' ?>>Všetko</option>
                    <option value="Stoly" <?= $filter === 'Stoly' ? 'selected' : '' ?>>Stoly</option>
                    <option value="Stolíky" <?= $filter === 'Stolíky' ? 'selected' : '' ?>>Stolíky</option>
                    <option value="Komody" <?= $filter === 'Komody' ? 'selected' : '' ?>>Komody</option>
                    <option value="Nočné stolíky" <?= $filter === 'Nočné stolíky' ? 'selected' : '' ?>>Nočné stolíky</option>
                    <option value="Lavice" <?= $filter === 'Lavice' ? 'selected' : '' ?>>Lavice</option>
                    <option value="Police" <?= $filter === 'Police' ? 'selected' : '' ?>>Police</option>
                    <option value="Postele" <?= $filter === 'Postele' ? 'selected' : '' ?>>Postele</option>
                </select>
            </div>

            <div>
                <label for="sort"><strong>Zoradiť podľa:</strong></label>
                <select name="sort" id="sort" onchange="this.form.submit()">
                    <option value="nazov_asc" <?= $sort === 'nazov_asc' ? 'selected' : '' ?>>Názov A – Z</option>
                    <option value="nazov_desc" <?= $sort === 'nazov_desc' ? 'selected' : '' ?>>Názov Z – A</option>
                    <option value="kategoria_asc" <?= $sort === 'kategoria_asc' ? 'selected' : '' ?>>Kategória A – Z</option>
                    <option value="kategoria_desc" <?= $sort === 'kategoria_desc' ? 'selected' : '' ?>>Kategória Z – A</option>
                    <option value="cena_asc" <?= $sort === 'cena_asc' ? 'selected' : '' ?>>Cena od najnižšej</option>
                    <option value="cena_desc" <?= $sort === 'cena_desc' ? 'selected' : '' ?>>Cena od najvyššej</option>
                </select>
            </div>
        </form>

        <div class="product-grid">
            <?php
            if ($result && $result->num_rows > 0):
                while ($produkt = $result->fetch_assoc()):
            ?>
                <article class="product-card">
                    <div class="product-thumb">
                        <?php
                        $imagePath = __DIR__ . '/../assets/images/produkty/' . $produkt['hlavny_obrazok'];
                        if (!empty($produkt['hlavny_obrazok']) && file_exists($imagePath)):
                        ?>
                            <img src="assets/images/produkty/<?= htmlspecialchars($produkt['hlavny_obrazok']) ?>" alt="<?= htmlspecialchars($produkt['nazov']) ?>">
                        <?php else: ?>
                            <div class="no-image">Obrázok</div>
                        <?php endif; ?>
                    </div>

                    <div class="product-body">
                        <h2><?= htmlspecialchars($produkt['nazov']) ?></h2>
                        <p><a class="category" href="index.php?page=katalog&kategoria=<?= urlencode($produkt['kategoria']) ?>">
                        <?= htmlspecialchars($produkt['kategoria']) ?>
                        </a></p>
                        <p><?= htmlspecialchars($produkt['kratky_popis']) ?></p>
                        <p><strong>Materiál:</strong> <?= htmlspecialchars($produkt['material']) ?></p> 
                        <p class="price">Cena od: <?= number_format((float)$produkt['cena_od'], 2, ',', ' ') ?> €</p>
                        <a href="index.php?page=detail&id=<?= (int)$produkt['id'] ?>" class="btn btn-small">Zobraziť detail</a>
                    </div>
                </article>
            <?php
                endwhile;
            else:
                echo '<p>V tejto kategórii sa zatiaľ nenachádzajú žiadne produkty.</p>';
            endif;
            ?>
        </div>
    </div>
</section>