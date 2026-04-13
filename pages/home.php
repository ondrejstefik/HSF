<section class="hero home-hero">
    <div class="container hero-content">
        <h2>Ručne vyrábaný nábytok z masívu</h2>
        <p>Objavte poctivý slovenský nábytok, ktorý spája remeslo, prírodné materiály a možnosť individuálneho výberu moridla.</p>
        <div class="hero-buttons">
            <a href="index.php?page=katalog" class="btn">Pozrieť katalóg</a>
            <a href="index.php?page=kontakt" class="btn btn-outline">Napísať nám</a>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-heading">
            <h2>Prečo HSF</h2>
            <p>Malosériová výroba, kvalitné drevo a dôraz na detail.</p>
        </div>

        <div class="features-grid">
            <article class="card">
                <h3>Ručná výroba</h3>
                <p>Každý kus nábytku vzniká s dôrazom na remeselnú presnosť a individuálny prístup.</p>
            </article>

            <article class="card">
                <h3>Masívne drevo</h3>
                <p>Používame kvalitné materiály vhodné do moderných aj rustikálnych interiérov.</p>
            </article>

            <article class="card">
                <h3>Výber moridla</h3>
                <p>Zákazník si môže zvoliť farebné prevedenie dreva podľa svojho interiéru.</p>
            </article>
        </div>
    </div>
</section>

<section class="section section-alt">
    <div class="container">
        <div class="section-heading">
            <h2>Vybrané produkty</h2>
            <p>Ukážka našej aktuálnej ponuky.</p>
        </div>

        <div class="product-grid">
            <?php
            $sql = "SELECT id, nazov, kratky_popis, cena_od, hlavny_obrazok 
                    FROM produkty 
                    WHERE aktivny = 1 
                    ORDER BY id DESC 
                    LIMIT 3";
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
                            <div class="no-image">obrázok</div>
                        <?php endif; ?>
                    </div>

                    <div class="product-body">
                        <h3><?= htmlspecialchars($produkt['nazov']) ?></h3>
                        <p><?= htmlspecialchars($produkt['kratky_popis']) ?></p>
                        <p class="price">Cena od: <?= number_format((float)$produkt['cena_od'], 2, ',', ' ') ?> €</p>
                        <a href="index.php?page=detail&id=<?= (int)$produkt['id'] ?>" class="btn btn-small">Detail</a>
                    </div>
                </article>
            <?php
                endwhile;
            else:
                echo '<p>Zatiaľ nie sú pridané žiadne produkty.</p>';
            endif;
            ?>
        </div>
    </div>
</section>