<?php
ob_start();
?>

    <h1 class="title">Ajouter une clef</h1>
    <form action="/user/addClef" method="post">
        <label for="key">Clef</label>
        <input type="text" name="key" id="key" placeholder="numéros de la clef" required>

        <label for="code">Code de la clef</label>
        <input type="text" name="code" id="code" placeholder="code de la clef" required>

        <input class="button" type="submit" name="login" value="Ajouter la clef">
    </form>
<?php if (isset($error)): ?>
    <p class="error"><?= $error ?></p>
<?php endif; ?>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/../base.php';
?>