    <footer>
        <p>
            <!-- Ecrit la temps que la page à mit à charger, et regarde si le temps est inférieur ou supérieur à 1.01 secondes pour savoir si l'on met un s à seconde -->
            It took <span><?= round(microtime(TRUE) - $time, 3) ?></span> second<?= (round(microtime(TRUE) - $time, 3) <= 1.01) ? '' : 's' ?> to load the page
        </p>
    </footer>
    </main>
    <!-- Fait une condition pour savoir si l'on se trouve sur la page game.php, pour y injecter el js -->
    <?php if($_SERVER['SCRIPT_NAME'] == '/game.php'): ?>

        <script src="../assets/js/game.js"></script>

    <?php endif; ?>
</body>
</html>