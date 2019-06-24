<?php
session_start();
if ($_SESSION['owner_id'] == null) {
    include '../view/auth_failed.php';
} else {
    echo "<br/><div style='text-align: center;font-size: 44px'>[ Manage Cats ]</div>";


    include '../view/menu.php';
    require '../model/owner_model.php';
    require '../model/cats_model.php';
    require '../model/cats_database.php';
    require '../model/tourniment_model.php';
    require '../model/tourn_apply_model.php';

    $ownerModel = new OwnerModel();
    $catModel = new CatModel();
    $tornimentModel = new TournamentModel();
    $tournApplyModel = new TournApplyModel();

    switch ($_GET['action']) {
        case "add":
            {
                $arr = array($_POST['name'], $_POST['age'], $_POST['cat_model'], $_POST['owner_id']);
                if (in_array(null, $arr, true) || in_array("", $arr, true)) {

                    echo "<br/><br/><br/> <fieldset><br/><br/><br/><div style=' text-align: center;vertical-align: middle;font-size: 22px;'>"
                        . "<b>Wrong params provided || Some fields Are Empty</b>"
                        . "<a href='../view/add_cat.php'>  [ Back to Cats ]</a></div><br/><br/><br/></fieldset>";
                } else {

                    $catModel->addCat($_POST['name'], $_POST['age'], $_POST['cat_model'], $_POST['owner_id']);

                    echo "<br/><br/><br/> <fieldset><br/><br/><br/><div style=' text-align: center;vertical-align: middle;font-size: 22px;'>"
                        . "<b>Cat added " . $_POST['name'] . "</b><a href='../view/add_cat.php'>  [ Back to Add Cat ]</a></div><br/><br/><br/></fieldset>";

                }
                break;
            }
        case "manage":
        {
            $cats = $catModel->getAllCatsByOwnerId($_SESSION['owner_id']);

            foreach ($cats as $k => $v) {
                $catId = $cats[$k]['cat_id'];
                $tourniments = $tournApplyModel->getAllByCatId($catId);
                $cats[$k]['tourniments'] = $tourniments;
            }
            include '../view/menage_cat.php';
            break;
        }
        case "del":
            {
                $tournApplyModel->cancelAllByCatId($_GET['id']);
                $catModel->deleteCat($_GET['id']);

                echo "<br/><br/><br/> <fieldset><br/><br/><br/><div style=' text-align: center;vertical-align: middle;font-size: 22px;'>"
                    . "<b>Cat ID Deleted: " . $_GET['id'] . "</b><a href='../controller/cat_controller.php?action=manage'>"
                    . "[ Back Cat Manage ]</a></div><br/><br/><br/></fieldset>";
                break;
            }
        case "reset":
            {
                $tournApplyModel->cancelAllByCatId($_GET['id']);

                echo "<br/><br/><br/> <fieldset><br/><br/><br/><div style=' text-align: center;vertical-align: middle;font-size: 22px;'>"
                    . "<b>Cat unrigistered from tourniments: " . $_GET['id'] . "</b><a href='../controller/cat_controller.php?action=manage'>"
                    . "[ Back Cat Manage ]</a></div><br/><br/><br/></fieldset>";
                break;
            }
    }
}