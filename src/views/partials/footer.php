<?php
$current_page = basename($_SERVER['PHP_SELF']);
$beforeLink = '../../';
if ($current_page === 'index.php') {
    $beforeLink = 'src/';
}
?>
</main>

<footer class="footer">
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
<script src="https://unpkg.com/split-type"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.3/TextPlugin.min.js"></script>
<script src="<?= $beforeLink . 'app/partials/header.js'?>"></script>
</body>
</html>