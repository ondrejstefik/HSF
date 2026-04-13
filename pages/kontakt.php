<?php
$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $meno = trim($_POST['meno'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $sprava = trim($_POST['sprava'] ?? '');

    if ($meno === '') {
        $errors[] = 'Prosím, zadajte meno.';
    }

    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Prosím, zadajte platný e-mail.';
    }

    if ($sprava === '') {
        $errors[] = 'Prosím, zadajte správu.';
    }

    if (empty($errors)) {
        $stmt = $conn->prepare("INSERT INTO spravy (meno, email, sprava) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $meno, $email, $sprava);

        if ($stmt->execute()) {
            $success = 'Správa bola úspešne odoslaná na spracovanie.';
        } else {
            $errors[] = 'Nastala chyba pri odosielaní formulára.';
        }

        $stmt->close();
    }
}
?>

<section class="page-hero telephone-hero">
    <div class="container hero-content">
        <h2>Kontakt</h2>
        <p>Máte záujem o výrobok, cenovú ponuku alebo individuálnu realizáciu? Napíšte nám.</p>
    </div>
</section>

<section class="section">
    <div class="container form-layout">
        <div>
            <h2>Kontaktné údaje</h2>
            <p><strong>HSF - Handmade Slovak Furniture</strong></p>
            <p>Košice, Slovensko</p>
            <p>E-mail: info@hsf.sk</p>
            <p>Telefón: +421 900 000 000</p>
        </div>

        <div>
            <h2>Napíšte nám</h2>

            <?php if (!empty($errors)): ?>
                <div class="alert alert-error">
                    <?php foreach ($errors as $error): ?>
                        <p><?= htmlspecialchars($error) ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if ($success !== ''): ?>
                <div class="alert alert-success">
                    <p><?= htmlspecialchars($success) ?></p>
                </div>
            <?php endif; ?>

            <form action="index.php?page=kontakt" method="post" class="contact-form">
                <label for="meno">Meno a priezvisko</label>
                <input type="text" id="meno" name="meno" required>

                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" required>

                <label for="sprava">Správa</label>
                <textarea id="sprava" name="sprava" rows="6" required></textarea>

                <button type="submit" class="btn">Odoslať správu</button>
            </form>
        </div>
    </div>
</section>