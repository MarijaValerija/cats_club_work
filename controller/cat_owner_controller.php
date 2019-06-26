<?php
session_start();
if ($_SESSION['owner_id'] == null) {
    include '../view/auth_failed.php';
} else {
    echo "<br/><div style='text-align: center;font-size: 44px'>[ Manage Cat Owners ]</div>";


    include '../view/menu.php';
    require '../model/owner_model.php';
    require '../model/cats_model.php';
    require '../model/cats_database.php';

    $ownerModel = new OwnerModel();
    $catModel = new CatModel();
    switch ($_GET['action']) {
        case "add":
            {
                $arr = array($_POST['name'], $_POST['phone'], $_POST['personal_code'], $_POST['username'], $_POST['password']);
                if (in_array(null, $arr, true) || in_array("", $arr, true)) {

                    echo "<br/><br/><br/> <fieldset><br/><br/><br/><div style=' text-align: center;vertical-align: middle;font-size: 22px;'>"
                        . "<b>Wrong params provided || Some fields Are Empty</b>"
                        . "<a href='../view/add_cat_owner.php'>  [ Back to Add CatOwner ]</a></div><br/><br/><br/></fieldset>";
                } else {

                    $ownerModel->addCatOwner($_POST['name'], $_POST['phone'], $_POST['personal_code'], $_POST['username'], $_POST['password']);

                    echo "<br/><br/><br/> <fieldset><br/><br/><br/><div style=' text-align: center;vertical-align: middle;font-size: 22px;'>"
                        . "<b>Cat Owner Added: " . $_POST['name'] . "</b><a href='../view/add_cat_owner.php'>  [ Back to Add CatOwner ]</a></div><br/><br/><br/></fieldset>";

                }
                break;
            }
        case "manage":
            {
                $catOwners = $ownerModel->viewCatOwners();
                foreach ($catOwners as $k => $v) {
                    $ownerId = $catOwners[$k]['owner_id'];
                    $cats = $catModel->getAllCatsByOwnerId($ownerId);
                    $catOwners[$k]['cat_owned'] = $cats;
                }
                include '../view/menage_cat_owner.php';
                break;
            }
        case "del":
            {
                $catModel->deleteAllCatsByOwnerId($_GET['id']);
                $ownerModel->deleteCatOwnerById($_GET['id']);

                echo "<br/><br/><br/> <fieldset><br/><br/><br/><div style=' text-align: center;vertical-align: middle;font-size: 22px;'>"
                    . "<b>Cat Owner with ID Deleted: " . $_GET['id'] . "</b><a href='../controller/cat_owner_controller.php?action=manage'>"
                    . "[ Back to Owner Manage ]</a></div><br/><br/><br/></fieldset>";
                break;
            }
        case "res":
            {
                $ownerModel->catOwnerSetDefaultPassword($_GET['id']);

                echo "<br/><br/><br/> <fieldset><br/><br/><br/><div style=' text-align: center;vertical-align: middle;font-size: 22px;'>"
                    . "<b>Cat Owner reset password to default: " . $_GET['id'] . "</b><a href='../controller/cat_owner_controller.php?action=manage'>"
                    . "[ Back to Owner Manage ]</a></div><br/><br/><br/></fieldset>";
                break;
            }

    }


}