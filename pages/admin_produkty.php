
<?php
if (empty($_SESSION['admin_logged_in'])) {
    header('Location: index.php?page=login');
    exit;
}
?>
<?php
$sql = "SELECT * FROM produkty ORDER BY id DESC";
$result = $conn->query($sql);
?>

<section class="page-hero">
    <div class="container hero-content">
        <h2>Správa produktov</h2>
        <p>Jednoduchá administrácia produktov katalógu.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <h2>Zoznam produktov</h2>
        <p>
            <a href="index.php?page=produkt_pridat" class="btn">Pridať nový produkt</a>
            <a href="index.php?page=logout" class="btn btn-secondary">Odhlásiť sa</a>
        </p>

        <?php if ($result && $result->num_rows > 0): ?>
            <div class="admin-table-wrapper">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Názov</th>
                            <th>Kategória</th>
                            <th>Cena od</th>
                            <th>Aktívny</th>
                            <th>Akcie</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($produkt = $result->fetch_assoc()): ?>
                            <tr>
                                <td>
                                    <?= (int) $produkt['id'] ?>
                                </td>
                                <td>
                                    <?= htmlspecialchars($produkt['nazov']) ?>
                                </td>
                                <td>
                                    <?= htmlspecialchars($produkt['kategoria']) ?>
                                </td>
                                <td>
                                    <?= number_format((float) $produkt['cena_od'], 2, ',', ' ') ?> €
                                </td>
                                <td>
                                    <?= (int) $produkt['aktivny'] === 1 ? 'Áno' : 'Nie' ?>
                                </td>
                                <td>
                                    <a href="index.php?page=produkt_upravit&id=<?= (int) $produkt['id'] ?>">Upraviť</a>
                                    |
                                  <?php if ((int)$produkt['aktivny'] === 1): ?>
                                <a href="index.php?page=produkt_zmazat&id=<?= (int)$produkt['id'] ?>"
                                onclick="return confirm('Naozaj chcete deaktivovať tento produkt?');">
                                    Deaktivovať
                                </a> 
                                <?php else: ?>
                                    <a href="index.php?page=produkt_aktivovat&id=<?= (int)$produkt['id'] ?>"
                                    onclick="return confirm('Naozaj chcete znovu aktivovať tento produkt?');">
                                        Aktivovať
                                    </a>
                                <?php endif; ?>
                                 |<a href="index.php?page=produkt_zmazat&id=<?= (int)$produkt['id'] ?>"
                                    onclick="return confirm('Naozaj chcete tento produkt natrvalo vymazať?');">
                                    Vymazať
                                </a>

                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p>V databáze zatiaľ nie sú žiadne produkty.</p>
        <?php endif; ?>
    </div>
</section>