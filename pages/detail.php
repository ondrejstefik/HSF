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
    <div class="container hero-content">
        <h2>Produkt nebol nájdený</h2>
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
    <div class="container hero-content">
        <h2><?= htmlspecialchars($produkt['nazov']) ?></h2>
        <p><?= htmlspecialchars($produkt['kratky_popis']) ?></p>
    </div>
</section>

<section class="section">
    <div class="container detail-grid">
        <div class="detail-image">
            <?php
            $imagePath = __DIR__ . '/../assets/images/produkty/' . $produkt['hlavny_obrazok'];
            if (!empty($produkt['hlavny_obrazok']) && file_exists($imagePath)):
            ?>
                <img src="assets/images/produkty/<?= htmlspecialchars($produkt['hlavny_obrazok']) ?>" alt="<?= htmlspecialchars($produkt['nazov']) ?>">
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
            <p>
                Tento výrobok je možné vyhotoviť vo viacerých odtieňoch moridla.
                Pre zobrazenie vzoriek kliknite na tlačidlo nižšie.
            </p>

            <button type="button" class="btn btn-secondary" id="openMoridlaModal">
                Zobraziť moridlá
            </button>
        </div>
            <a href="index.php?page=kontakt" class="btn">Mám záujem o tento výrobok</a>
        </div>
    </div>
</section>
<div id="moridlaModal" class="moridla-modal">
    <div class="moridla-modal-content">
        <button type="button" class="moridla-close" id="closeMoridlaModal">&times;</button>

        <h2>Dostupné moridlá</h2>
        <p class="moridla-note-top">
            Odtieň sa môže mierne líšiť podľa <strong>druhu dreva, kresby materiálu</strong> a svetelných podmienok fotografie.
        </p>

        <div class="moridla-grid">
            <div class="moridlo-card">
                <img src="assets/images/moridla/dub-prirodny.webp" alt="Dub prírodný">
                <h4>Dub prírodný</h4>
            </div>

            <div class="moridlo-card">
                <img src="assets/images/moridla/dub-svetly.webp" alt="Dub svetlý">
                <h4>Dub svetlý</h4>
            </div>

            <div class="moridlo-card">
                <img src="assets/images/moridla/orech.webp" alt="Orech">
                <h4>Orech</h4>
            </div>

            <div class="moridlo-card">
                <img src="assets/images/moridla/gastan.webp" alt="Gaštan">
                <h4>Gaštan</h4>
            </div>

            <div class="moridlo-card">
                <img src="assets/images/moridla/wenge.webp" alt="Wenge">
                <h4>Wenge</h4>
            </div>

            <div class="moridlo-card">
                <img src="assets/images/moridla/biela.webp" alt="Biela">
                <h4>Biela</h4>
            </div>
            <div class="moridlo-card">
                <img src="assets/images/moridla/siva.webp" alt="Sivá">
                <h4>Sivá</h4>
            </div>

            <div class="moridlo-card">
                <img src="assets/images/moridla/cierna.webp" alt="Čierna">
                <h4>Čierna</h4>
            </div>

            <div class="moridlo-card">
                <img src="assets/images/moridla/teak.webp" alt="Teak">
                <h4>Teak</h4>
            </div>

            <div class="moridlo-card">
                <img src="assets/images/moridla/mahagon.webp" alt="Mahagón">
                <h4>Mahagón</h4>
            </div>
        </div>

        <p class="moridla-note-bottom">
            <strong>Poznámka:</strong> Máte záujem o konkrétny odtieň? Uveďte ho pri odoslaní dopytu alebo nás kontaktujte.
        </p>
    </div>
</div>
<?php endif; ?>