    <footer>
        <p>
            La page a mis <span><?= round(microtime(TRUE) - $time, 3) ?></span> secondes à charger
        </p>
    </footer>
    </main>
    <?php if($_SERVER['SCRIPT_NAME'] == '/game.php'): ?>

        <script src="../assets/js/game.js"></script>

    <?php endif; ?>
</body>
</html>