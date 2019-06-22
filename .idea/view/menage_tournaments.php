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
            <th>Description</th>
            <th>Cats</th>
            <th>[ Delete ]</th>
        </tr>
        <?php

        if (isset($tournaments)) {
            foreach ($tournaments as $k => $v) {
                $catsInfoString = " ";

                $cats = $catOwners[$k]['cat_participate'];
                foreach ($cats as $c => $j) {
                    if (isset($cats[$c]['name']) && isset($cats[$c]['cat_id'])) {
                        $catsInfoString = $catsInfoString . $cats[$c]['name'] . "  (" . $cats[$c]['cat_id'] . ")<br/>";
                    }
                }
                echo "<tr>"
                    . "<td>" . $tournaments[$k]['name'] . "</td > "
                    . "<td>" . $tournaments[$k]['description'] . "</td > "
                    . "<td>" . $catsInfoString . "</td > "
                    . "<td><a href='../controller/tourniment_controller.php?action=del&id=" . $tournaments[$k]['tourniment_id'] . "'>[ DELETE ]</a></td>"
                    . "</tr>";
            }
        }
        ?>
    </table>
</div>
</body>
</html>