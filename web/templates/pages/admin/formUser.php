<?php
ob_start();
/**
 * @var string $userName,
 * @var string $firstName,
 * @var string $lastName,
 * @var string $email,
 * @var string $role,
 * @var string $error,
 */
?>

<h1>Ajouter un utilisateur</h1>
<form action="/admin/user/add" method="post">
    <label for="username">Nom d'utilisateur</label>
    <input type="text" id="username" name="username" value="<?php if (isset($userName)) {echo $userName;} ?>" required>
    <label for="firstname">Prénom</label>
    <input type="text" id="firstname" name="firstname" value="<?php if (isset($firstName)) {echo $firstName;} ?>" required>
    <label for="lastname">Nom</label>
    <input type="text" id="lastname" name="lastname" value="<?php if (isset($lastName)) {echo $lastName;} ?>" required>
    <label for="email">Email</label>
    <input type="email" id="email" name="email" value="<?php if (isset($email)) {echo $email;} ?>" required>
    <label for="password">Mot de passe</label>
    <input type="password" id="password" name="password" required>
    <label for="role">Role</label>
    <input type="radio" name="role" id="role-student" value="student" <?php if (empty($role) && $role == "student") : ?>checked<?php endif;?>>
    <label for="key-no">étudient</label>
    <input type="radio" name="role" id="role-admin" value="admin" <?php if ($role == "admin") : ?>checked<?php endif;?>>
    <label for="key-yes">admin</label>
    <button type="submit">Ajouter</button>
</form>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/../base.php';
?>