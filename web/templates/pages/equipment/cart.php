<?php
ob_start();
?>
<?php
ob_start();
/**
 * @var array $cart
 */
?>
<h1>Cart</h1>
<?php if (empty($cart)): ?>
    <p>Ton panier est vide</p>
<?php else: ?>
    <table>
        <thead>
        <tr>
            <th>Equipment</th>
            <th>Quantity</th>
            <th>Start date</th>
            <th>End date</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($cart as $item): ?>
            <tr>
                <td><?= $item['name'] ?></td>
                <td><?= $item['quantity'] ?></td>
                <td><?= $item['start'] ?></td>
                <td><?= $item['end'] ?></td>
                <td>
                    <form action="/equipment/deleteFromCart" method="post">
                        <input type="hidden" name="id" value="<?= $item['id_cart'] ?>">
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <form action="/equipment/validateCart" method="post">
        <button type="submit">Validate</button>
    </form>
    <?php if (isset($error)): ?>
        <p><?= $error ?></p>
    <?php endif; ?>
<?php endif; ?>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/../base.php';
?>