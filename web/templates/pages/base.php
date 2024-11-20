<!DOCTYPE html>
<html lang="fr">
<?php require_once __DIR__ . '/../partials/head.php'; ?>
<body>
<?php require_once __DIR__ . '/../partials/header.php'; ?>

<main>
    <?php if (isset($content)) echo $content; ?>
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
</body>
</html>
