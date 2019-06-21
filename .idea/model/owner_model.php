<?php
if ($_SESSION['owner_id'] == null) {
    include '../view/auth_failed.php';
    die;
}

const GET_CAT_OWNER_BY_ID = "SELECT owner_id, name, phone, personal_code, username, password, role"
    . " FROM cat_owners WHERE owner_id = ?";

const ADD_CAT_OWNER = "INSERT INTO cat_owners(name, phone, personal_code, username, password, role) "
    . " VALUES (?,?,?,?,?,?)";

const VIEW_CATS_OWNERS = "SELECT owner_id, name, phone, personal_code, username, password, role"
    . " FROM cat_owners";

const DELETE_CAT_OWNER_BY_ID = "DELETE FROM cat_owners WHERE owner_id = ?";

const RESET_PASSWORD_CAT_OWNER_BY_ID = "UPDATE cat_owners SET PASSWORD = ? WHERE owner_id = ?";


class OwnerModel
{

    public function addCatOwner($name, $phone, $personalCode, $username, $password)
    {
        $conn = CatsDatabaseConnectionManager::getConnection();
        $md5Hash = md5($password);
        $role = 'USER';
        $stmt = $conn->prepare(ADD_CAT_OWNER);
        $stmt->bind_param("ssssss", $name, $phone, $personalCode, $username, $md5Hash, $role);
        $stmt->execute();
        $boolResult = $stmt->get_result();
        $stmt->close();
        $conn->close();
        return $boolResult;
    }

    public function deleteCatOwnerById($id)
    {
        $conn = CatsDatabaseConnectionManager::getConnection();
        $stmt = $conn->prepare(DELETE_CAT_OWNER_BY_ID);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $boolResult = $stmt->get_result();
        $stmt->close();
        $conn->close();
        return $boolResult;
    }

    public function viewCatOwners()
    {
        $conn = CatsDatabaseConnectionManager::getConnection();
        $stmt = $conn->prepare(VIEW_CATS_OWNERS);
        $stmt->execute();
        $result = CatsDatabaseConnectionManager::createArrayFromDBresultObject($stmt->get_result());
        $stmt->close();
        $conn->close();
        return $result;
    }

    public function catOwnerSetDefaultPassword($id)
    {
        $conn = CatsDatabaseConnectionManager::getConnection();
        $stmt = $conn->prepare(RESET_PASSWORD_CAT_OWNER_BY_ID);
        $defaultMd5Hash = md5('default');
        $stmt->bind_param("si", $defaultMd5Hash,$id);
        $stmt->execute();
        $boolResult = $stmt->get_result();
        $stmt->close();
        $conn->close();
        return $boolResult;
    }



}