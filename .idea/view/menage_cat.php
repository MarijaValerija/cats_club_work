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
            <th>Age</th>
            <th>Cat Model</th>
            <th>Tourniments</th>
            <th>[ Delete ]</th>
            <th>[ Unregister ]</th>
        </tr>
        <?php

        if(isset($cats)){
            foreach ($cats as $k => $v) {
            $tournimentForCats = $cats[$k]['tourniments'];
                    $catsInfoString = " ";

                    foreach ($tournimentForCats as $c => $j) {
                        if(isset($tournimentForCats[$c]['tourniment_id'])){
                            $catsInfoString = $catsInfoString  . $tournimentForCats[$c]['tourniment_id'] ."<br/>";
                        }
                    }

                    echo  "<tr>"
                        . "<td>".$cats[$k]['name']."</td > "
                        . "<td>".$cats[$k]['age']."</td > "
                        . "<td>".$cats[$k]['cat_model']."</td > "
                        . "<td>".$catsInfoString."</td > "
                        . "<td><a href='../controller/cat_controller.php?action=del&id=".$cats[$k]['cat_id']."'>[ DELETE ]</a></td>"
                        . "<td><a href='../controller/cat_controller.php?action=reset&id=".$cats[$k]['cat_id']."'>[ UNREGISTER ]</a></td>"
                        . "</tr>";
                }
        }
        ?>
    </table>
</div>
</body>
</html>