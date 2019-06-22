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
    <form action="../controller/cat_owner_controller.php?action=add" method="post">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" placeholder="Name..">

        <label for="phone">Phone</label>
        <input type="text" id="phone" name="phone" placeholder="Phone..">

        <label for="phone">Personal Code</label>
        <input type="text" id="personal_code" name="personal_code" placeholder="Personal Code..">

        <label for="phone">Username</label>
        <input type="text" id="username" name="username" placeholder="Username..">

        <label for="phone">Password</label>
        <input type="password" id="password" name="password" placeholder="Password..">


        <!--        <label for="country">Country</label>
                <select id="country" name="country">
                    <option value="australia">Australia</option>
                    <option value="canada">Canada</option>
                    <option value="usa">USA</option>
                </select>
        -->
        <input type="submit" value="Submit">
    </form>
</div>

</body>
</html>
