<?php
session_start();
if ($_SESSION['owner_id'] == null) {
    include 'auth_failed.php';
} else {
    echo "<br/><div style='text-align: center;font-size: 44px'>[ Add Cat ]</div>";
    include '../view/menu.php';

}
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../resources/css/main_form.css"/>
</head>
<body>
<div>
    <form action="../controller/cat_controller.php?action=add" method="post">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" placeholder="Name..">

        <label for="phone">Phone</label>
        <input type="text" id="age" name="age" placeholder="Age..">

        <label for="phone">Cat model</label>
        <input type="text" id="cat_model" name="cat_model" placeholder="Cat Model..">

        <input type="hidden" id="owner_id" name="owner_id" value="<?php echo $_SESSION['owner_id'] ?>">

        <input type="submit" value="Submit">
    </form>
</div>

</body>
</html>
