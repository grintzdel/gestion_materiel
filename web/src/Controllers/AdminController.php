<?php

use App\Database\DatabaseManager;
use App\Helpers\Template;
use App\Repository\CategorieRepository;
use App\Repository\EquipmentRepository;
use App\Repository\UserRepository;
use App\Validator\Equipment;

class AdminController
{
    public function listEquipment()
    {
        if (!$_SESSION['user_info']) {
            header('Location: /connexion');
        }
        if ($_SESSION['user_info']['role'] !== 'admin') {
            header('Location: /profil');
        }

        $materials = EquipmentRepository::getAll();
        $categories = CategorieRepository::getAllCategorie();

        Template::renderTemplate('templates/pages/admin/listEquipment.php', [
            'categories' => $categories,
            'materials' => $materials,
        ]);
    }


    public function addEquipment()
    {
        if (!$_SESSION['user_info']) {
            header('Location: /connexion');
        }
        if ($_SESSION['user_info']['role'] !== 'admin') {
            header('Location: /profil');
        }
        $error = null;

        $name             = htmlspecialchars(filter_input(INPUT_POST, 'name'));
        $description      = htmlspecialchars(filter_input(INPUT_POST, 'description'));
        $available        = htmlspecialchars(filter_input(INPUT_POST, 'available')) ?? 0;
        $total            = htmlspecialchars(filter_input(INPUT_POST, 'total')) ?? 0;
        $key              = htmlspecialchars(filter_input(INPUT_POST, 'key'));
        $image            = $_FILES['image'] ?? null;
        $categoriesSelect = $_POST['category'] ?? null;

        if (!empty($name) && !empty($description) && !empty($total) && !empty($key)) {
            try {
                Equipment::form(false, [
                    'name' => $name,
                    'description' => $description,
                    'available' => $available,
                    'total' => $total,
                    'key' => $key,
                    'image' => $image,
                    'categoriesSelect' => $categoriesSelect,
                ]);

                header('Location: /admin/equipment/list');
            } catch (Exception $e) {
                $error = $e->getMessage();
            }
        }

        $categories = CategorieRepository::getAllCategorie();

        Template::renderTemplate('templates/pages/admin/formEquipment.php', [
            'name'             => $name,
            'description'      => $description,
            'key'              => $key,
            'available'        => $available,
            'total'            => $total,
            'categoriesSelect' => [],
            'isEditing'        => false,
            'categories'       => $categories,
            'error'            => $error ?? null,
        ]);
    }

    public function editEquipment()
    {
        if (!$_SESSION['user_info']) {
            header('Location: /connexion');
        }
        if ($_SESSION['user_info']['role'] !== 'admin') {
            header('Location: /profil');
        }
        $error = null;
        $id_equipment = $_GET['id_equipment'];

        $equipment = EquipmentRepository::getOne($id_equipment);

        if (!$equipment) {
            header('Location: /admin/equipment/list');
            exit;
        }

        $name             = htmlspecialchars(filter_input(INPUT_POST, 'name'));
        $description      = htmlspecialchars(filter_input(INPUT_POST, 'description'));
        $available        = htmlspecialchars(filter_input(INPUT_POST, 'available'));
        $total            = htmlspecialchars(filter_input(INPUT_POST, 'total'));
        $key              = htmlspecialchars(filter_input(INPUT_POST, 'key'));
        $image            = $_FILES['image'] ?? null;
        $categoriesSelect = $_POST['category'] ?? null;

        if (!empty($name) && !empty($description) && !empty($total) && !empty($key)) {
            try {
                Equipment::form(true, [
                    'id_equipment' => $id_equipment,
                    'name' => $name,
                    'description' => $description,
                    'available' => $available,
                    'total' => $total,
                    'key' => $key,
                    'image' => $image,
                    'categoriesSelect' => $categoriesSelect,
                ]);

                header('Location: /admin/equipment/list');
            } catch (Exception $e) {
                $error = "Erreur lors de la modification de l'équipement : " . $e->getMessage();
            }

        }

        $equipment = EquipmentRepository::getOne($id_equipment);

        $name = $equipment['name'];
        $description = $equipment['description'];
        $key = $equipment['require_key'];
        $available = $equipment['available'];
        $total = $equipment['total'];
        $categoriesSelect = explode(',', $equipment['id_categories']);
        $categories = CategorieRepository::getAllCategorie();

        Template::renderTemplate('templates/pages/admin/formEquipment.php', [
            'id_equipment'     => $id_equipment,
            'name'             => $name,
            'description'      => $description,
            'key'              => $key,
            'categoriesSelect' => $categoriesSelect,
            'available'        => $available,
            'total'            => $total,
            'isEditing'        => true,
            'categories'       => $categories,
            'error'            => $error ?? null,
        ]);
    }

    public function deleteEquipment()
    {
        if (!$_SESSION['user_info']) {
            header('Location: /connexion');
            exit;
        }
        if ($_SESSION['user_info']['role'] !== 'admin') {
            header('Location: /profil');
            exit;
        }
        $id_equipment = $_GET['id_equipment'];

        EquipmentRepository::deleteById($id_equipment);

        header('Location: /admin/equipment/list');
    }

    public function listUser()
    {
        if (!$_SESSION['user_info']) {
            header('Location: /connexion');
            exit;
        }
        if ($_SESSION['user_info']['role'] !== 'admin') {
            header('Location: /profil');
            exit;
        }

        $users = UserRepository::getAll();

        Template::renderTemplate('templates/pages/admin/listUser.php', [
            'users' => $users,
        ]);
    }

    public function addUser()
    {
        if (!$_SESSION['user_info']) {
            header('Location: /connexion');
            exit;
        }
        if ($_SESSION['user_info']['role'] !== 'admin') {
            header('Location: /profil');
            exit;
        }

        $error = null;

        $userName = htmlspecialchars(filter_input(INPUT_POST, 'username'));
        $firstName = htmlspecialchars(filter_input(INPUT_POST, 'firstname'));
        $lastName = htmlspecialchars(filter_input(INPUT_POST, 'lastname'));
        $email = htmlspecialchars(filter_input(INPUT_POST, 'email'));
        $role = htmlspecialchars(filter_input(INPUT_POST, 'role'));
        $password = htmlspecialchars(filter_input(INPUT_POST, 'password'));

        if (
            !empty($userName)  &&
            !empty($firstName) &&
            !empty($lastName)  &&
            !empty($email)     &&
            !empty($role)      &&
            !empty($password)
        ) {
            try {
                UserRepository::addUser($userName, $firstName, $lastName, $email, $role, $password);
                header('Location: /admin/user/list');
            } catch (Exception $e) {
                $error = $e->getMessage();
            }
        }

        Template::renderTemplate('templates/pages/admin/formUser.php', [
            'username' => $userName,
            'firstname' => $firstName,
            'lastname' => $lastName,
            'email' => $email,
            'role' => $role,
            'error' => $error,
        ]);
    }
}
