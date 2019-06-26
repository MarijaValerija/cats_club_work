<?php
session_start();
if ($_SESSION['owner_id'] == null) {
    include '../view/auth_failed.php';
} else {
    echo "<br/><div style='text-align: center;font-size: 44px'>[ Manage Tournaments ]</div>";


    include '../view/menu.php';
    require '../model/tourniment_model.php';
    require '../model/cats_model.php';
    require '../model/tourn_apply_model.php';
    require '../model/cats_database.php';

    $tournamentModel = new TournamentModel();
    $tourApplyModel = new TournApplyModel();
    $catsModel = new CatModel();

    switch ($_GET['action']) {
        case "add":
            {
                $arr = array($_POST['name'], $_POST['description']);
                if (in_array(null, $arr, true) || in_array("", $arr, true)) {

                    echo "<br/><br/><br/> <fieldset><br/><br/><br/><div style=' text-align: center;vertical-align: middle;font-size: 22px;'>"
                        . "<b>Wrong params provided || Some fields Are Empty</b>"
                        . "<a href='../view/add_tournament.php'>  [ Back to Add Tournaments ]</a></div><br/><br/><br/></fieldset>";
                } else {

                    $tournamentModel->addTournament($_POST['name'], $_POST['description']);

                    echo "<br/><br/><br/> <fieldset><br/><br/><br/><div style=' text-align: center;vertical-align: middle;font-size: 22px;'>"
                        . "<b>Tournament Added: " . $_POST['name'] . "</b><a href='../view/add_tournament.php'>"
                        . " [ Back to Tournament ]</a></div><br/><br/><br/></fieldset>";

                }
                break;
            }
        case "manage":
            {
                $tournaments = $tournamentModel->getAllTournaments();

                foreach ($tournaments as $k => $v) {
                    $tournamentId = $tournaments[$k]['tourniment_id'];
                    $cats = $catsModel->getAllCatsByTournamentId($tournamentId);
                    $catOwners[$k]['cat_participate'] = $cats;
                }

                include '../view/menage_tournaments.php';
                break;
            }
        case "del":
            {
                $tourApplyModel->deleteAllByTournimentId($_GET['id']);
                $tournamentModel->deleteTournament($_GET['id']);

                echo "<br/><br/><br/> <fieldset><br/><br/><br/><div style=' text-align: center;vertical-align: middle;font-size: 22px;'>"
                    . "<b>Tournament with ID Canceled: " . $_GET['id'] . "</b><a href='../controller/tourniment_controller.php?action=manage'>"
                    . "[ Back to Tournaments Manage ]</a></div><br/><br/><br/></fieldset>";
                break;
            }
        case "update":
            {
                $tournamentModel->catOwnerSetDefaultPassword($_GET['id']);

                echo "<br/><br/><br/> <fieldset><br/><br/><br/><div style=' text-align: center;vertical-align: middle;font-size: 22px;'>"
                    . "<b>TournamentUpdated: " . $_GET['id'] . "</b><a href='../controller/tourniment_controller.php?action=manage'>"
                    . "[ Back to Tournaments Manage ]</a></div><br/><br/><br/></fieldset>";
                break;
            }

        case "view":
            {
                $catsByOwner = $catsModel->getAllCatsByOwnerId($_SESSION['owner_id']);
                $tournaments = $tournamentModel->getAllTournaments();
                include '../view/view_tournaments.php';
                break;
            }

        case "add_cat":
            {
                $catsByOwner = $catsModel->getAllCatsByOwnerId($_SESSION['owner_id']);
                $tournaments = $tournamentModel->getAllTournaments();
                include '../view/view_tournaments.php';
                break;
            }
    }


}


