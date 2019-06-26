<?php
if ($_SESSION['owner_id'] == null) {
    include 'auth_failed.php';
}else{
    echo "<br/><div style='text-align: right'> Wellcome, <b>".$_SESSION['name']."</b></div>";


    var_dump($_SESSION);
}

?>
<html>
<head>
    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        .topnav {
            overflow: hidden;
            background-color: #333;
        }

        .topnav a {
            float: left;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }

        .topnav a:hover {
            background-color: #ddd;
            color: black;
        }

        .topnav a.active {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>
<div class="topnav">

    <?php
    if ($_SESSION['role'] == 'USER') {
        ?>

        <td><a href="../view/add_cat.php">Register Cat</a></td>
        <td><a href="../controller/cat_controller.php?action=manage">Menage Cat</a></td>
        <td><a href="../controller/tourniment_controller.php?action=view">View Tournaments</a></td>
        <td><a href="../controller/logout.php">Log out</a></td>
        </tr>
        <?php
    } else if ($_SESSION['role'] == 'ADMIN') {
        ?>
        <tr>
            <td><a href="../view/add_cat_owner.php">Register cat owner</a></td>
            <td><a href="../view/add_tournament.php">Create Tournament</a></td>
            <td><a href="../controller/tourniment_controller.php?action=manage">Manage Tournament</a></td>
            <td><a href="../controller/cat_owner_controller.php?action=manage">Manage Owners</a></td>
            <td><a href="../controller/logout.php">Log out</a></td>
        </tr>
        <?php
    }
    ?>
</div>
</body>
</html>

