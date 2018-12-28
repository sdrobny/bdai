<?php
/**
 * Created by PhpStorm.
 * User: Szymon
 * Date: 07.11.2018
 * Time: 20:03
 */
session_start();
if (!isset($_SESSION['username'])) $_SESSION['username'] = 'guest';
if (!isset($_SESSION['role'])) $_SESSION['role'] = 1;
if (!isset($_SESSION['logged'])) $_SESSION['logged'] = 0;
if (!isset($_POST['id'])) {
    header("Location: list.php");
    die();
}
else {
    /* Get speaker */
    require ('../connection.php');
    $exists = false;
    $statement = 'SELECT * FROM speaker WHERE id = "'.$_POST['id'].'";';
    $query = $pdo->query($statement);
    if ($query->rowCount() > 0 ) {
        $speaker = $query->fetch();
    }
    else header("Location: list.php");
}
?>

<html>
<head>
    <?php include('../head.html'); ?>
</head>
<body>
<header class="">
    <h1>Edycja prelegenta</h1>
</header>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a href="list.php" class="btn btn-primary">Powrót</a>
</nav>

<div class="col-xs-12 col-md-6 col-md-push-3 border border-light">


    <form action="edit-update.php" method="post" enctype="multipart/form-data">

        <input type="hidden" value="<?php echo $speaker['id'] ?>" name="id">
        <input type="hidden" value="<?php echo $speaker['image'] ?>" name="imgpath">

        <div class="row">
            <div class="form-group">
                <label for="name">Imię</label>
                <input type="text" minlength="3" class="form-control" id="name" name="name" value="<?php echo $speaker['name'] ?>" required/>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <label for="surname">Nazwisko</label>
                <input type="text" minlength="3" class="form-control" id="surname" name="surname" value="<?php echo $speaker['surname'] ?>" required/>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <label for="specialization">Specjalizacja</label>
                <input type="text" minlength="3" class="form-control" id="specialization" name="specialization" value="<?php echo $speaker['specialization'] ?>" required/>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <?php if ($speaker['image'] != "") echo('<img class="photo" src="../upload/'.$speaker['image'].'">'); ?>
                <input type="file" name="image" id="image" class="col-md-12"/>
            </div>
        </div>


        <div class="row">
            <input type="submit" class="btn btn-success" value="Wykonaj">
        </div>
    </form>


    <?php
    if ($_SESSION['role'] == 3 || $_SESSION['role' == 2]) {
        //Hmmm...
    } else if ($_SESSION['role'] == 1) {
        header("Location: ../no-permission.php");
        die();
    } else {
        header("Location: ../login.php");
        die();
    }
    ?>
</div>
</body>
</html>
