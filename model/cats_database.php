<?php

class CatsDatabaseConnectionManager {


    public static function getConnection() { //static=opredeljajet staticheskie svojstva i metodi

        $host = "localhost";
        $username ="root";
        $password = "";
        $dbname = "cats_club";

        // Create connection
        $conn = new mysqli($host, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }

    public static function createArrayFromDBresultObject($resultobj) { //array=masivs
        if($resultobj->num_rows == 0) {
            return array();
        }
        else {
            $array = array();
            while($line = $resultobj->fetch_array(MYSQLI_ASSOC)) {
                array_push($array,$line);
            }
            return $array;
        }
    }

}
