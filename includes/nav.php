<nav class="site-nav">
    <div class="container nav-inner">
          <a href="index.php?page=home" class="nav-logo" aria-label="HSF - Domov">
            <img src="assets/images/clean_logo_brown.webp" alt="HSF">
         </a>
        <button class="menu-toggle" id="menuToggle" aria-label="Otvoriť menu">
            ☰
        </button>

        <ul class="nav-list" id="navList">
            <li><a href="index.php?page=home" class="<?= $page === 'home' ? 'active' : '' ?>">Domov</a></li>
            <li><a href="index.php?page=katalog" class="<?= $page === 'katalog' ? 'active' : '' ?>">Katalóg</a></li>
            <li><a href="index.php?page=realizacie" class="<?= $page === 'realizacie' ? 'active' : '' ?>">Realizácie</a></li>
            <li><a href="index.php?page=onas" class="<?= $page === 'onas' ? 'active' : '' ?>">O nás</a></li>
            <li><a href="index.php?page=kontakt" class="<?= $page === 'kontakt' ? 'active' : '' ?>">Kontakt</a></li>
        </ul>
    </div>
</nav>