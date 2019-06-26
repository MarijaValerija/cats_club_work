<?php
session_start();
if ($_SESSION['owner_id'] == null) {
    include '../view/auth_failed.php';
} else {
    echo "<br/><div style='text-align: center;font-size: 44px'>[ Apply Cat to Tourniment ]</div>";


    include '../view/menu.php';
    require '../model/tourniment_model.php';
    require '../model/cats_model.php';
    require '../model/tourn_apply_model.php';
    require '../model/cats_database.php';

    $tournamentModel = new TournamentModel();
    $tourApplyModel = new TournApplyModel();
    $catsModel = new CatModel();

    switch ($_GET['action']) {
        case "add_cat":
            {
                $arr = array($_POST['cat_id'], $_POST['tourniment_id']);
                if (in_array(null, $arr, true) || in_array("", $arr, true)) {

                    echo "<br/><br/><br/> <fieldset><br/><br/><br/><div style=' text-align: center;vertical-align: middle;font-size: 22px;'>"
                        . "<b>Wrong params provided || Some fields Are Empty</b>"
                        . "<a href='../controller/tourniment_controller.php?action=view'>  [ Back to View Tournaments ]</a></div><br/><br/><br/></fieldset>";
                } else {

                    $tourApplyModel->addTournApply($_POST['cat_id'], $_POST['tourniment_id']);

                    echo "<br/><br/><br/> <fieldset><br/><br/><br/><div style=' text-align: center;vertical-align: middle;font-size: 22px;'>"
                        . "<b>cat Applied: " . $_POST['cat_id'] . "</b><a href='../controller/tourniment_controller.php?action=view'>"
                        . " [ View Tournaments ]</a></div><br/><br/><br/></fieldset>";

                }
                break;
            }
    }
}