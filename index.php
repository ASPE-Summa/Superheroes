<?php
include_once "./classes/dbHandler.php";
$dbHandler = new dbHandler();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Heroes</title>
    <link rel="stylesheet" href="./style/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/fontawesome.min.js"></script>
</head>

<body>
    <header class="jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">Superheroes</h1>
        </div>
    </header>

    <?php
    if (isset($_POST['create'])) {
        if ($dbHandler->createHero($_POST['name'], $_POST['publisher'])) {
            echo '<div class="alert alert-success" role="alert">Superhero created</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Superhero creation failed</div>';
        }
    } else if (isset($_POST['edit'])) {
        if ($dbHandler->updateHero($_POST["superheroId"], $_POST['name'], $_POST['publisher'])) {
            echo '<div class="alert alert-success" role="alert">Superhero updated</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Superhero update failed</div>';
        }
    } else if (isset($_POST["delete"])) {
        if ($dbHandler->deleteHero($_POST["superheroId"])) {
            echo '<div class="alert alert-success" role="alert">Superhero deleted</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Superhero deletion failed</div>';
        }
    }

    ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>publisher</th>
                <th>actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $rows = $dbHandler->selectSuperheroes();
            foreach ($rows as $row) {
            ?>
                <tr>
                    <td><?= $row['superheroId']; ?></td>
                    <td><?= $row['name']; ?></td>
                    <td><?= $row['publisher']; ?></td>
                    <td>
                        <form method="POST" action="edit.php">
                            <input type="hidden" name="superheroId" value="<?= $row['superheroId'] ?>" />
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-pen"></i>
                            </button>
                        </form>
                        <form method="POST" action="index.php">
                            <input type="hidden" name="superheroId" value="<?= $row['superheroId'] ?>" />
                            <button type="submit" name="delete" class="btn btn-danger">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <form method='post' action='create.php'>
        <button type='submit' class="btn btn-success">
            <i class="fa fa-plus"></i> Create
        </button>
    </form>
</body>

</html>