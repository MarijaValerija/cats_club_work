<?php
if ($_SESSION['owner_id'] == null) {
    include '../view/auth_failed.php';
    die;
}

const ADD_TOURNIMENT = "INSERT INTO tourniments(name, description) VALUES (?,?)";
const DELETE_TOURNIMENT_BY_ID = "DELETE FROM tourniments WHERE tourniment_id = ?";
const GET_TOURNIMENT_BY_ID = "SELECT tourniment_id, name, description FROM tourniments WHERE tourniment_id = ?";
const GET_ALL_TOURNIMENT = "SELECT tourniment_id, name, description FROM tourniments";
const UPDATE_TOURNIMENT = "UPDATE tourniments SET name = ?, description = ? WHERE tourniment_id ?";

class TournamentModel
{
    public function addTournament($name, $description)
    {
        $conn = CatsDatabaseConnectionManager::getConnection();
        $stmt = $conn->prepare(ADD_TOURNIMENT);
        $stmt->bind_param("ss", $name, $description);
        $stmt->execute();
        $boolResult = $stmt->get_result();
        $stmt->close();
        $conn->close();
        return $boolResult;
    }

    public function deleteTournament($id)
    {
        $conn = CatsDatabaseConnectionManager::getConnection();
        $stmt = $conn->prepare(DELETE_TOURNIMENT_BY_ID);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $boolResult = $stmt->get_result();
        $stmt->close();
        $conn->close();
        return $boolResult;
    }

    public function getAllTournaments()
    {
        $conn = CatsDatabaseConnectionManager::getConnection();
        $stmt = $conn->prepare(GET_ALL_TOURNIMENT);
        $stmt->execute();
        $result = CatsDatabaseConnectionManager::createArrayFromDBresultObject($stmt->get_result());
        $stmt->close();
        $conn->close();
        return $result;
    }

    public function getAllTournamentById($id)
    {
        $conn = CatsDatabaseConnectionManager::getConnection();
        $stmt = $conn->prepare(GET_TOURNIMENT_BY_ID);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = CatsDatabaseConnectionManager::createArrayFromDBresultObject($stmt->get_result());
        $stmt->close();
        $conn->close();
        return $result;
    }


    public function getAllTournamentByCatId($id)
    {
        $conn = CatsDatabaseConnectionManager::getConnection();
        $stmt = $conn->prepare(GET_ALL_CATS_BY_TOURNAMENT_ID);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = CatsDatabaseConnectionManager::createArrayFromDBresultObject($stmt->get_result());
        $stmt->close();
        $conn->close();
        return $result;
    }

    public function updateTournament($newName, $newDescription, $id)
    {
        $conn = CatsDatabaseConnectionManager::getConnection();
        $stmt = $conn->prepare(UPDATE_TOURNIMENT);
        $stmt->bind_param("ssi", $newName, $newDescription, $id);
        $stmt->execute();
        $boolResult = $stmt->get_result();
        $stmt->close();
        $conn->close();
        return $boolResult;
    }


}

