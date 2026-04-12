<footer class="site-footer">
    <div class="container footer-grid">
        <div>
            <h3>mini kalendár</h3>
                    <?php include __DIR__ . '/../includes/mini_kalendar.php'; ?>
                  
        </div>

        <div>
            <h3>Rýchle odkazy</h3>

        
           <ul class="footer-links">
                <li><p><a href="index.php?page=admin_produkty">Administrácia</a></p></li>
                <li><p><a href="index.php?page=zadanie">Zadanie projektu</a></p></li>
                <li><p><a href="https://tinyurl.com/4be573kv" target="_blank" rel="noopener noreferrer">Odkaz na PSD layout</a></p></li>

                <li><p><a href="https://developer.mozilla.org/en-US/docs/Web/HTML" target="_blank" rel="noopener noreferrer">HTML – MDN Web Docs</a></p></li>
                <li><p><a href="https://developer.mozilla.org/en-US/docs/Web/CSS" target="_blank" rel="noopener noreferrer">CSS – MDN Web Docs</a></p></li>
                <li><p><a href="https://developer.mozilla.org/en-US/docs/Web/JavaScript/Guide" target="_blank" rel="noopener noreferrer">JavaScript – MDN Web Docs</a></p></li>
                <li><p><a href="https://www.php.net/manual/en/" target="_blank" rel="noopener noreferrer">PHP – Official Manual</a></p></li>
                <li><p><a href="https://api.jquery.com/" target="_blank" rel="noopener noreferrer">jQuery – API Documentation</a></p></li>
                <li><p><a href="https://validator.w3.org/" target="_blank" rel="noopener noreferrer">W3C HTML Validator</a></p></li>
                <li><p><a href="https://jigsaw.w3.org/css-validator/" target="_blank" rel="noopener noreferrer">W3C CSS Validator</a></p></li>
            </ul>
        </div>

        <div>
            <h3>Kontakt</h3>
            <p>Ing. Ondrej Štefik</p>
            <p>E-mail: o.stefik@ostrovskeho.com</p>
            <p>Telefón: +421 900 000 000</p>
            <p>Košice, Slovensko</p>
        </div>
    </div>

    <div class="copyright">
        <p>&copy; <?= date('Y') ?> HSF - Handmade Slovak Furniture</p>
    </div>
</footer>

<script src="assets/js/script.js"></script>
</body>
</html>