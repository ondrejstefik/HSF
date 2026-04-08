<?php
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$stmt = $conn->prepare("SELECT * FROM produkty WHERE id = ? AND aktivny = 1 LIMIT 1");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$produkt = $result->fetch_assoc();

if (!$produkt):
?>
<section class="section">
    <div class="container">
        <h1>Produkt nebol nájdený</h1>
        <p>Požadovaný produkt neexistuje alebo už nie je aktívny.</p>
        <a href="index.php?page=katalog" class="btn">Späť do katalógu</a>
    </div>
</section>
<?php
else:
    $moridlaStmt = $conn->prepare("
        SELECT m.id, m.nazov, m.hex_farba
        FROM moridla m
        INNER JOIN produkt_moridla pm ON pm.moridlo_id = m.id
        WHERE pm.produkt_id = ?
        ORDER BY m.nazov ASC
    ");
    $moridlaStmt->bind_param("i", $id);
    $moridlaStmt->execute();
    $moridlaResult = $moridlaStmt->get_result();
?>
<section class="page-hero">
    <div class="container">
        <h1><?= htmlspecialchars($produkt['nazov']) ?></h1>
        <p><?= htmlspecialchars($produkt['kratky_popis']) ?></p>
    </div>
</section>

<section class="section">
    <div class="container detail-grid">
        <div class="detail-image">
            <?php
            $imagePath = __DIR__ . '/../assets/images/' . $produkt['hlavny_obrazok'];
            if (!empty($produkt['hlavny_obrazok']) && file_exists($imagePath)):
            ?>
                <img src="assets/images/<?= htmlspecialchars($produkt['hlavny_obrazok']) ?>" alt="<?= htmlspecialchars($produkt['nazov']) ?>">
            <?php else: ?>
                <div class="no-image detail-no-image">Sem doplníš hlavný obrázok produktu</div>
            <?php endif; ?>
        </div>

        <div class="detail-content">
            <h2>Informácie o produkte</h2>
            <p><?= nl2br(htmlspecialchars($produkt['popis'])) ?></p>

            <ul class="detail-list">
                <li><strong>Materiál:</strong> <?= htmlspecialchars($produkt['material']) ?></li>
                <li><strong>Rozmery:</strong> <?= htmlspecialchars($produkt['rozmery']) ?></li>
                <li><strong>Cena od:</strong> <?= number_format((float)$produkt['cena_od'], 2, ',', ' ') ?> €</li>
            </ul>

            <div class="moridla-box">
                <h3>Dostupné moridlá</h3>

                <?php if ($moridlaResult && $moridlaResult->num_rows > 0): ?>
                    <div class="stain-options">
                        <?php
                        $firstStain = null;
                        $index = 0;
                        while ($moridlo = $moridlaResult->fetch_assoc()):
                            if ($index === 0) {
                                $firstStain = $moridlo['nazov'];
                            }
                        ?>
                            <label class="stain-chip">
                                <input type="radio" name="moridlo" value="<?= htmlspecialchars($moridlo['nazov']) ?>" <?= $index === 0 ? 'checked' : '' ?>>
                                <span class="stain-color" style="background-color: <?= htmlspecialchars($moridlo['hex_farba']) ?>;"></span>
                                <span><?= htmlspecialchars($moridlo['nazov']) ?></span>
                            </label>
                        <?php
                            $index++;
                        endwhile;
                        ?>
                    </div>

                    <p class="selected-stain">Vybrané moridlo: <strong id="selectedMoridlo"><?= htmlspecialchars($firstStain) ?></strong></p>
                <?php else: ?>
                    <p>Pre tento produkt zatiaľ nie sú definované moridlá.</p>
                <?php endif; ?>
            </div>

            <a href="index.php?page=kontakt" class="btn">Mám záujem o tento výrobok</a>
        </div>
    </div>
</section>
<?php endif; ?>