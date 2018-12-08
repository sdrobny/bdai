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
    /* Get partner */
    require ('../connection.php');
    $exists = false;
    $statement = 'SELECT * FROM important_dates WHERE id = "'.$_POST['id'].'";';
    $query = $pdo->query($statement);
    if ($query->rowCount() > 0 ) {
        $important = $query->fetch();
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
    <h1>Edycja Ważnej daty</h1>
    <?php  include('../topbar.php') ?>
</header>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a href="list.php" class="btn btn-primary">Powrót</a>
</nav>

<div class="col-xs-12 col-md-6 col-md-push-3 border border-light">


    <form action="edit-update.php" method="post" enctype="multipart/form-data">

        <input type="hidden" value="<?php echo $important['id'] ?>" name="id">

        <div class="row">
            <div class="form-group">
                <label for="date">Data</label>
                <input type="date"  class="form-control" id="date" name="date" value="<?php echo date('Y-m-d' , strtotime($important['date'])) ?>"/>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <label for="description">Opis</label>
                <input type="text" minlength="3" class="form-control" id="description" name="description" value="<?php echo $important['description'] ?>">
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <label for="conference">Konferencja</label>
                <select class="form-control" id="conference" name="conference" required>
                    <?php
                    require ('../connection.php');
                    $statement = 'SELECT * FROM conference ';
                    $query = $pdo->query($statement);

                    if ($query->rowCount() > 0)
                    {
                        foreach ($query as $row)
                        {
                            if ($important['conference_id'] == $row['id'])
                            {
                                echo '<option value="'.$row['id'].' selected">'.$row['tittle'].'</option>' ;
                            }
                            else
                            {
                            echo '<option value="'.$row['id'].'">'.$row['tittle'].'</option>' ;
                            }
                        }
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="row">
            <input type="submit" class="btn btn-success" value="Wykonaj">
        </div>
    </form>


    <?php
    if ($_SESSION['role'] == 3) {
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
