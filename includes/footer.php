    <footer>
        <p>
            It took <span><?= round(microtime(TRUE) - $time, 3) ?></span> second<?= (round(microtime(TRUE) - $time, 3) <= 1.01) ? '' : 's' ?> to load the page
        </p>
    </footer>
    </main>
    <?php if($_SERVER['SCRIPT_NAME'] == '/game.php'): ?>

        <script src="../assets/js/game.js"></script>

    <?php endif; ?>
</body>
</html>