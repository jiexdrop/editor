<?php
require_once "../config.php";

function fetch_data($mysqli, $id)
{
    $sql = "SELECT id, content FROM contents WHERE id='" . strval($id) . "'";

    $result = $mysqli->query($sql);

    $row = $result->fetch_row();

    if (empty($row[1])) {
        return "Click here to edit template";
    } else {
        return $row[1];
    }
}

$first_col_data = "";
$second_col_data = "";
$third_col_data = "";

$first_col_data = fetch_data($mysqli, 1);
$second_col_data = fetch_data($mysqli, 2);
$third_col_data = fetch_data($mysqli, 3);


?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm" id="col-1" type="text" name="col-1" contenteditable="true">
            <?php echo $first_col_data ?>
        </div>
        <textarea id="col-1-hidden" name="col-1-hidden" style="display:none;"></textarea>
        <div class="col-sm" id="col-2" type="text" name="col-2" contenteditable="true">
            <?php echo $second_col_data ?>
        </div>
        <textarea id="col-2-hidden" name="col-2-hidden" style="display:none;"></textarea>
        <div class="col-sm" id="col-3" type="text" name="col-3" contenteditable="true">
            <?php echo $third_col_data ?>
        </div>
        <textarea id="col-3-hidden" name="col-3-hidden" style="display:none;"></textarea>
    </div>
</div>