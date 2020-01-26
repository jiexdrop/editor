<?php
require_once "config.php";

session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $col_1_hidden = $_POST["col-1-hidden"];
    $col_2_hidden = $_POST["col-2-hidden"];
    $col_3_hidden = $_POST["col-3-hidden"];

    insert_update_col($mysqli, 1, $col_1_hidden);
    insert_update_col($mysqli, 2, $col_2_hidden);
    insert_update_col($mysqli, 3, $col_3_hidden);
}

function insert_update_col($mysqli, $id, $content){
    $sql = $mysqli->query("SELECT * FROM contents WHERE ID = $id");

    if (mysqli_num_rows($sql) > 0) 
    {
        $sqlUpdate="UPDATE contents SET Content= '$content' WHERE ID = $id";
        $mysqli->query($sqlUpdate);
    } else {
        $sqlInsert="INSERT INTO contents SET ID = $id, Content= '$content'";
        $mysqli->query($sqlInsert);
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/editor.js"></script>
    <title>editor</title>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Template</h5>
                <p class="card-text">Base template</p>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-base-template-modal">Open</button>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Template</h5>
                <p class="card-text">Other template</p>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-base-template-modal">Open</button>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Template</h5>
                <p class="card-text">Other template</p>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-base-template-modal">Open</button>
            </div>
        </div>
    </div>


    <div class="modal fade bd-base-template-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="templates.php" method="POST" class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>You can edit your template pressing on the fields you want to edit.</p>
                        <div id="editor-template"></div>
                    </div>
                    <div class="modal-footer">
                        <button id="editor-save" type="submit" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</body>

</html>