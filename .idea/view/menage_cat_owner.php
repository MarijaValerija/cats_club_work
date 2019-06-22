<?php
if ($_SESSION['owner_id'] == null) {
    include '../view/auth_failed.php';
    die;
}
echo "<br/>";
echo "<br/>";
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../resources/css/main_form.css"/>
</head>


<body>
<div>
    <table id="catowners">
        <tr>
            <th>Name</th>
            <th>Personal Code</th>
            <th>username</th>
            <th>Cats</th>
            <th>[ Delete ]</th>
            <th>[ Reset Password ]</th>
        </tr>
        <?php

        if(isset($catOwners)){
            foreach ($catOwners as $k => $v) {
                if($catOwners[$k]['role'] != 'ADMIN'){
                    $catsOwnedByOwner = $catOwners[$k]['cat_owned'];
                    $catsInfoString = " ";

                    foreach ($catsOwnedByOwner as $c => $j) {
                        if(isset($catsOwnedByOwner[$c]['name']) && isset($catsOwnedByOwner[$c]['cat_id'])){
                            $catsInfoString = $catsInfoString  . $catsOwnedByOwner[$c]['name'] .  "  (" . $catsOwnedByOwner[$c]['cat_id'] . ")<br/>";
                        }
                    }

                    echo  "<tr>"
                        . "<td>".$catOwners[$k]['name']."</td > "
                        . "<td>".$catOwners[$k]['personal_code']."</td > "
                        . "<td>".$catOwners[$k]['username']."</td > "
                        . "<td>".$catsInfoString."</td > "
                        . "<td><a href='../controller/cat_owner_controller.php?action=del&id=".$catOwners[$k]['owner_id']."'>[ DELETE ]</a></td>"
                        . "<td><a href='../controller/cat_owner_controller.php?action=res&id=".$catOwners[$k]['owner_id']."'>[ RESET ]</a></td>"
                        . "</tr>";
                }
            }
        }
        ?>
    </table>
</div>
</body>
</html>