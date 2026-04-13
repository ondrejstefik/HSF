<?php
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $heslo = $_POST['heslo'] ?? '';

   if ($heslo === '0000') {
    session_regenerate_id(true);
    $_SESSION['admin_logged_in'] = true;
    $_SESSION['last_activity'] = time();

    header('Location: index.php?page=admin_produkty');
    exit;
} else {
    $error = 'Nesprávne heslo.';
}
}
?>

<section class="page-hero">
    <div class="container hero-content">
        <h2>Prihlásenie do administrácie</h2>
        <p>Zadajte heslo pre vstup do správy produktov.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <?php if (!empty($error)): ?>
            <p class="form-error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <h2>Prihlasovací formulár</h2>
        <form action="index.php?page=login" method="post" class="admin-form" style="max-width: 420px;">
            <p>
                <label for="heslo">Heslo</label><br>
                <input type="password" id="heslo" name="heslo" required>
            </p>

            <p>
                <button type="submit" class="btn">Prihlásiť sa</button>
            </p>
        </form>
    </div>
</section>