<?php
session_start();
if ($_SESSION['owner_id'] == null) {
    include 'auth_failed.php';
} else {
    echo "<br/><div style='text-align: center;font-size: 44px'>[ Register Cat Owner ]</div>";
    include '../view/menu.php';
}
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../resources/css/main_form.css"/>
</head>
<body>
<div>
    <form action="../controller/tourniment_controller.php?action=add" method="post">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" placeholder="Name..">

        <label for="description">Description</label>
        <textarea id="description" name="description" placeholder="Description..."></textarea>

        <input type="submit" value="Submit">
    </form>
</div>

</body>
</html>
