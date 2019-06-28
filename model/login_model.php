<?php


require 'cats_database.php';//include

const GET_CAT_OWNER_BY_USERNAME_AND_PASS = "SELECT owner_id, name, phone, personal_code, username, password, role"
    . " FROM cat_owners WHERE username = ? AND password = ? ";

class LoginModel
{
    public function getCatOwnerByUserNameAndPassword($username, $password)
    {
        $conn = CatsDatabaseConnectionManager::getConnection();

        $stmt = $conn->prepare(GET_CAT_OWNER_BY_USERNAME_AND_PASS);//prepare=Подготавливает запрос к выполнению и возвращает связанный с этим запросом объект
        $md5Hash = md5($password);
        $stmt->bind_param("ss", $username, $md5Hash);//bp=Привязка переменных к параметрам подготавливаемого запроса
        $stmt->execute();
        $result = CatsDatabaseConnectionManager::createArrayFromDBresultObject($stmt->get_result());


        $stmt->close();
        $conn->close();

        return $result;
    }
}