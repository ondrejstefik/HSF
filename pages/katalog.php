<section class="page-hero katalog-hero"> 
    <div class="container">
        <h1>Katalóg nábytku</h1>
        <p>Vyberte si z našej ponuky ručne vyrábaného nábytku z masívu.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="product-grid">
            <?php
            $sql = "SELECT id, nazov, kratky_popis, material, cena_od, hlavny_obrazok 
                    FROM produkty 
                    WHERE aktivny = 1 
                    ORDER BY nazov ASC";
            $result = $conn->query($sql);

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
                        <p><?= htmlspecialchars($produkt['kratky_popis']) ?></p>
                        <p><strong>Materiál:</strong> <?= htmlspecialchars($produkt['material']) ?></p>
                        <p class="price">Cena od: <?= number_format((float)$produkt['cena_od'], 2, ',', ' ') ?> €</p>
                        <a href="index.php?page=detail&id=<?= (int)$produkt['id'] ?>" class="btn btn-small">Zobraziť detail</a>
                    </div>
                </article>
            <?php
                endwhile;
            else:
                echo '<p>V databáze sa zatiaľ nenachádzajú žiadne produkty.</p>';
            endif;
            ?>
        </div>
    </div>
</section>