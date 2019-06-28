<?php
if ($_SESSION['owner_id'] == null) {
    include '../view/auth_failed.php';
    die;
}

const ADD_TOURN_APPLY = "INSERT INTO tourniment_apply(cat_id, tourniment_id) VALUES (?,?)";
const DELETE_ALL_PARTICIPANTS_BY_TOURNIMENT_ID = "DELETE FROM tourniment_apply WHERE tourniment_id = ?";
const CANCEL_CAT_PARTICIPATE = "DELETE FROM tourniment_apply WHERE tourniment_id = ? AND cat_id = ?";
const CANCEL_ALL_APPLY_BY_CAT_ID = "DELETE FROM tourniment_apply WHERE cat_id = ?";
const GET_BY_CAT_ID = "SELECT cat_id, tourniment_id FROM tourniment_apply WHERE cat_id = ?";
const GET_BY_TOURNIMENT_ID = "SELECT cat_id, tourniment_id FROM tourniment_apply WHERE tourniment_id = ?";
const GET_ALL = "SELECT cat_id, tourniment_id FROM tourniment_apply";

class TournApplyModel{
    public function addTournApply($catId, $tournimentId)
    {
        $conn = CatsDatabaseConnectionManager::getConnection();
        $stmt = $conn->prepare(ADD_TOURN_APPLY);
        $stmt->bind_param("ss", $catId, $tournimentId);//bp=Привязка переменных к параметрам подготавливаемого запроса
        $stmt->execute();//e=Запускает подготовленный запрос на выполнение
        $boolResult = $stmt->get_result();
        $stmt->close();
        $conn->close();
        return $boolResult;
    }

    public function deleteAllByTournimentId($id)
    {
        $conn = CatsDatabaseConnectionManager::getConnection();
        $stmt = $conn->prepare(DELETE_ALL_PARTICIPANTS_BY_TOURNIMENT_ID);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $boolResult = $stmt->get_result();
        $stmt->close();
        $conn->close();
        return $boolResult;
    }

    public function cancelCatParticipate($tourId, $catId){
        {
            $conn = CatsDatabaseConnectionManager::getConnection();
            $stmt = $conn->prepare(CANCEL_CAT_PARTICIPATE);
            $stmt->bind_param("ii", $tourId, $catId);
            $stmt->execute();
            $boolResult = $stmt->get_result();
            $stmt->close();
            $conn->close();
            return $boolResult;
        }
    }

    public function cancelAllByCatId($catId){
        {
            $conn = CatsDatabaseConnectionManager::getConnection();
            $stmt = $conn->prepare(CANCEL_ALL_APPLY_BY_CAT_ID);
            $stmt->bind_param("i", $catId);
            $stmt->execute();
            $boolResult = $stmt->get_result();
            $stmt->close();
            $conn->close();
            return $boolResult;
        }
    }

    public function getAllTournaments()
    {
        $conn = CatsDatabaseConnectionManager::getConnection();
        $stmt = $conn->prepare(GET_ALL);
        $stmt->execute();
        $result = CatsDatabaseConnectionManager::createArrayFromDBresultObject($stmt->get_result());
        $stmt->close();
        $conn->close();
        return $result;
    }

    public function getAllByCatId($id)
    {
        $conn = CatsDatabaseConnectionManager::getConnection();
        $stmt = $conn->prepare(GET_BY_CAT_ID);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = CatsDatabaseConnectionManager::createArrayFromDBresultObject($stmt->get_result());
        $stmt->close();
        $conn->close();
        return $result;
    }

    public function getAllByTournimentId($id)
    {
        $conn = CatsDatabaseConnectionManager::getConnection();
        $stmt = $conn->prepare(GET_BY_TOURNIMENT_ID);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = CatsDatabaseConnectionManager::createArrayFromDBresultObject($stmt->get_result());
        $stmt->close();
        $conn->close();
        return $result;
    }


}