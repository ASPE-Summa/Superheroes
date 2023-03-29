<?php
include_once "./classes/dbHandler.php";
$db = new dbHandler();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Create</title>
    <link rel="stylesheet" href="./style/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/fontawesome.min.js"></script>
</head>

<body>
    <header class="jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">Edit hero</h1>
        </div>
    </header>
    <?php
        if (isset($_POST["superheroId"])) {
            $row = $db->selectOne($_POST["superheroId"]);
        }
        ?>
    <div class="container-fluid">
        <form method='post' action='index.php'>
            <div class="row">
                <input type="hidden" name="superheroId" value="<?= $row['superheroId'] ?>"/>
                <div class="form-group col-md-6">
                    <label for="name">Name</label>
                    <input id="name" class="form-control" name="name" required value="<?= $row['name']?>"/>
                </div>
                <div class="form-group col-md-6">
                    <label for="publisher">Publisher</label>
                    <input id="publisher" class="form-control" name="publisher" required value="<?= $row['publisher']?>">
                </div>
                <button type="submit" class="btn btn-primary col-md-2" name='edit' value="edit" style="margin-top: 20px;">
                    <i class="fa fa-pen"></i> Edit
                </button>
            </div>
        </form>
    </div>
</body>

</html>