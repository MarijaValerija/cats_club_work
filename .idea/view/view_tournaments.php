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
            <th>Apply</th>
        </tr>
        <?php


        $catsInfoString = "<select name='cat_id' id='cat_id'><option value='0'></option>";
        foreach ($catsByOwner as $c => $j) {
            $catsInfoString = $catsInfoString . '<option value="' . $catsByOwner[$c]['cat_id'] . '">' . $catsByOwner[$c]['name'] . '</option>';
        }
        $catsInfoString = $catsInfoString . "</select>";
        if (isset($tournaments)) {
            foreach ($tournaments as $k => $v) {
                echo "<form action='../controller/tour_apply_controller.php?action=add_cat' method='post'><tr>"
                    . "<td>" . $tournaments[$k]['name'] . "</td > "
                    . "<td>" . $tournaments[$k]['description'] . "</td > "
                    . "<td>" . $catsInfoString . "</td > "
                    . "<td><input type='submit' value='Apply Cat'>"
                    . "<input type='hidden' name='tourniment_id' id='tourniment_id' value='" . $tournaments[$k]['tourniment_id'] . "'> </td > "
                    . "</tr></form>";
            }
        }
        ?>
    </table>
</div>
</body>
</html>