<?php

use App\Helpers\Date;
use App\Helpers\Template;
use App\Repository\CategorieRepository;
use App\Repository\EquipmentRepository;

class EquipmentController
{
    public function equipmentListAndTemplate()
    {
        EquipmentRepository::quantityUpdate();
        $materials = EquipmentRepository::getAll();
        $categories = CategorieRepository::getAllCategorie();

        Template::renderTemplate('templates/pages/equipment/equipmentList.php', [
            'categories' => $categories,
            'materials' => $materials,
        ]);
    }

    public function findEquipment()
    {
        // get the raw data from the request
        header('Content-Type: application/json');
        $rawData = file_get_contents('php://input');
        $data = json_decode($rawData, true);
        $categories = $data['categories'] ?? [];

        EquipmentRepository::quantityUpdate();
        if (empty($categories)) {
            $results = EquipmentRepository::getAll();
        } else {
            // Nettoyer les catégories
            $categories = array_map('htmlspecialchars', $categories);

            // Appeler le repository pour récupérer les équipements correspondants
            $results = EquipmentRepository::getEquipmentWithCategoriesId($categories);
        }


        switch ($data['availability']) {
            case 'true':
                $results = array_filter($results, function ($equipment) {
                    return $equipment['available'] >= 1;
                });
                break;
            case 'false':
                $results = array_filter($results, function ($equipment) {
                    return $equipment['available'] == 0;
                });
                break;
            default:
                break;
        }

        // Retourner les résultats sous forme de JSON
        echo json_encode(array_values($results));
    }

    public function showOne($id = null, $error = null)
    {
        EquipmentRepository::quantityUpdate();
        $id = intval($_GET['id'] ?? $id);

        $equipment = EquipmentRepository::getOne($id);
        if ($equipment === null) {
            header('Location: ' . __SITE_REPOSITORY__ . '/equipment');
            return;
        }

        Template::renderTemplate('templates/pages/equipment/showEquipment.php', [
            'equipment' => $equipment,
            'error'     => $error,
        ]);
    }


    public function addPannier()
    {
        if (!$_SESSION['user_info']) {
            header('Location: ' . __SITE_REPOSITORY__ . '/connexion');
            exit;
        }

        EquipmentRepository::quantityUpdate();

        $id_equipment = intval($_POST['id']) ?? null;
        $quantity     = max(1, intval($_POST['quantity'])) ?? null;
        $start_date   = isset($_POST['start_date']) ? Date::validateAndFormatDate($_POST['start_date']) : null;
        $end_date     = isset($_POST['end_date']) ? Date::validateAndFormatDate($_POST['end_date']) : null;
        $id_user      = $_SESSION['user_info']['id'];

        if ($id_equipment === null || $quantity === null || $start_date === null || $end_date === null) {
            $error = 'Veuillez remplir tous les champs';
            $this->showOne($id_equipment, $error);
            exit;
        }

        if ($quantity > EquipmentRepository::getOne($id_equipment)['available']) {
            $error = 'Pas assez de matériel disponible';
            $this->showOne($id_equipment, $error);
            exit;
        }

        if ($start_date > $end_date) {
            $error = 'La date de début doit être inférieure à la date de fin';
            $this->showOne($id_equipment, $error);
            exit;
        }

        if ($start_date < date('Y-m-d')) {
            $error = 'La date de début doit être supérieure à la date du jour';
            $this->showOne($id_equipment, $error);
            exit;
        }

        try {
            EquipmentRepository::addPannier($id_user, $id_equipment, $quantity, $start_date, $end_date);
            header('Location: ' . __SITE_REPOSITORY__ . '/equipment/listPannier');
        } catch (Exception $e) {
            $error = 'Erreur lors de l\'ajout au pannier : ' . $e->getMessage();
            $this->showOne($id_equipment, $error);
            exit;
        }
    }


    public function listPannier($error = null)
    {
        if (!$_SESSION['user_info']) {
            header('Location: ' . __SITE_REPOSITORY__ . '/connexion');
            exit;
        }

        $id_user = $_SESSION['user_info']['id'];
        $cart = EquipmentRepository::getPannier($id_user);
        $reservation = EquipmentRepository::getReservation($id_user);

        Template::renderTemplate('templates/pages/equipment/cart.php', [
            'cart'        => $cart,
            'error'       => $error,
            'reservation' => $reservation,
        ]);
    }

    public function deletePannier()
    {
        if (!$_SESSION['user_info']) {
            header('Location: ' . __SITE_REPOSITORY__ . '/connexion');
            exit;
        }

        $id = max(1, intval($_POST['id'])) ?? null;
        if ($id === null) {
            header('Location: ' . __SITE_REPOSITORY__ . '/equipment/listPannier');
            exit;
        }

        $this->listPannier(EquipmentRepository::deleteFromCart($id));
    }

    public function validateCart()
    {
        if (!$_SESSION['user_info']) {
            header('Location: ' . __SITE_REPOSITORY__ . '/connexion');
            exit;
        }
        EquipmentRepository::quantityUpdate();

        $id_user = $_SESSION['user_info']['id'];
        $carts = EquipmentRepository::getPannier($id_user);

        if (empty($carts)) {
            $this->listPannier('Votre panier est vide vous ne pouvez pas reserver');
            exit;
        }

        try {
            EquipmentRepository::addReservation($id_user, $carts);

            EquipmentRepository::deleteCart($id_user);
            header('Location: ' . __SITE_REPOSITORY__ . '/equipment/listPannier');
        } catch (Exception $e) {
            $this->listPannier('Erreur lors de la validation du panier : ' . $e->getMessage());
        }
    }
}