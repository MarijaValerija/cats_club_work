<?php
if ($_SESSION['owner_id'] == null) {
    include '../view/auth_failed.php';
    die; //funkcijai exit ekvivalents
}

const DELETE_ALL_CATS_BY_CAT_OWNER_ID = "DELETE FROM cats WHERE owner_id = ?";
const ADD_CAT = "INSERT INTO cats(name, age, cat_model, owner_id) VALUES (?,?,?,?)";
const GET_ALL_CATS_BY_TOURNAMENT_ID = "SELECT cat_id, name, age, cat_model, owner_id FROM cats "
    . " WHERE cat_id IN (SELECT cat_id FROM tourniment_apply WHERE tourniment_id = ? )";
const GET_ALL_CATS_BY_OWNER_ID = "SELECT cat_id, name, age, cat_model, owner_id FROM cats WHERE owner_id = ?";
const DELETE_ALL_CATS_BY_CAT_TOURNIMENT_ID = "DELETE FROM cats WHERE owner_id = ?";

const DELETE_CAT_BY_ID = "DELETE FROM cats WHERE cat_id = ?";


class CatModel
{
    public function deleteAllCatsByOwnerId($id)
    {
        $conn = CatsDatabaseConnectionManager::getConnection();
        $stmt = $conn->prepare(DELETE_ALL_CATS_BY_CAT_OWNER_ID);//queri-vipolnjajet zapros k baze dannih
        //stmt=rabota s operatorami bezopasneje chem vstavka peremenih v stroku SQL. Izpoljzuja zajavlenija fja zapreshaju sql injekciju.
        //prepare=Подготавливает запрос к выполнению и возвращает связанный с этим запросом объект
        $stmt->bind_param("i", $id);//Привязка переменных к параметрам подготавливаемого запроса...var izmanto php4, php 5 izmanto (public, p.., p..,)
        $stmt->execute();//zapuskajet podgotovlennij zapros
        $boolResult = $stmt->get_result();
        $stmt->close();
        $conn->close();
        return $boolResult;
    }

    public function addCat($name, $age, $model, $ownerId)
    {
        $conn = CatsDatabaseConnectionManager::getConnection();
        $stmt = $conn->prepare(ADD_CAT);//prepare=Подготавливает запрос к выполнению и возвращает связанный с этим запросом объект
        $stmt->bind_param("sisi", $name, $age, $model, $ownerId); //Привязка переменных к параметрам подготавливаемого запроса...var izmanto php4
        $stmt->execute();//zapuskajet podgotovlennij zapros
        $boolResult = $stmt->get_result();
        $stmt->close();
        $conn->close();
        return $boolResult;
    }

    public function deleteCat($id)
    {
        $conn = CatsDatabaseConnectionManager::getConnection();
        $stmt = $conn->prepare(DELETE_CAT_BY_ID);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $boolResult = $stmt->get_result();
        $stmt->close();
        $conn->close();
        return $boolResult;
    }

    public function getAllCatsByOwnerId($ownerId)
    {
        $conn = CatsDatabaseConnectionManager::getConnection();
        $stmt = $conn->prepare(GET_ALL_CATS_BY_OWNER_ID);
        $stmt->bind_param("i", $ownerId);
        $stmt->execute();
        $result = CatsDatabaseConnectionManager::createArrayFromDBresultObject($stmt->get_result());
        $stmt->close();
        $conn->close();
        return $result;
    }

    public function getAllCatsByTournamentId($tournId)
    {
        $conn = CatsDatabaseConnectionManager::getConnection();
        $stmt = $conn->prepare(GET_ALL_CATS_BY_TOURNAMENT_ID);
        $stmt->bind_param("i", $tournId);
        $stmt->execute();
        $result = CatsDatabaseConnectionManager::createArrayFromDBresultObject($stmt->get_result());
        $stmt->close();
        $conn->close();
        return $result;
    }
}
