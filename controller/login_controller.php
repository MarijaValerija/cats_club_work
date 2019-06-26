<?php

    require '../model/login_model.php';

    $username = $_POST["username"];
    $password = $_POST["password"];

    $loginModel = new LoginModel();
    $result = $loginModel->getCatOwnerByUserNameAndPassword($username, $password);

    //Auth check
    if(!empty($result)){
        @session_start();
        $_SESSION['owner_id'] = $result[0]['owner_id'];
        $_SESSION["role"] = $result[0]['role'];
        $_SESSION["name"] = $result[0]['name'];

        include '../view/menu.php';
    }else{
        include '../view/auth_failed.php';
    }
