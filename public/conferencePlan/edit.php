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
    $statement = 'SELECT * FROM conference_plan WHERE id = "'.$_POST['id'].'";';
    $query = $pdo->query($statement);
    if ($query->rowCount() > 0 ) {
        $conferencePlan = $query->fetch();
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
    <h1>Edycja Podwydarzenia Konferencji</h1>
    <?php  include('../topbar.php') ?>
</header>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a href="list.php" class="btn btn-primary">Powrót</a>
</nav>

<div class="col-xs-12 col-md-6 col-md-push-3 border border-light">


    <form action="edit-update.php" method="post" enctype="multipart/form-data">

        <input type="hidden" value="<?php echo $conferencePlan['id'] ?>" name="id">

        <div class="row">
            <div class="form-group">
                <label for="tittle">Tytuł</label>
                <input type="text" minlength="3" class="form-control" id="tittle" name="tittle" value="<?php echo $conferencePlan['tittle'] ?>">
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <label for="dateStart">Data rozpoczęcia</label>
                <?php  $datetime = new DateTime($conferencePlan['start_date']);   ?>
                <input type="datetime-local"  class="form-control" id="dateStart" name="dateStart" value="<?php echo $datetime->format('Y-m-d\TH:i:s'); ?>"/>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <label for="dateEnd">Data zakończenia</label>
                <?php  $datetime2 = new DateTime($conferencePlan['end_date']);   ?>
                <input type="datetime-local"  class="form-control" id="dateEnd" name="dateEnd" value="<?php echo $datetime2->format('Y-m-d\TH:i:s'); ?>"/>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <label for="description">Opis</label>
                <input type="text" minlength="3" class="form-control" id="description" name="description" value="<?php echo $conferencePlan['description'] ?>">
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
                            if ($conferencePlan['conference_id'] == $row['id'])
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
            <div class="form-group">
                <label for="speaker">Prelegent</label>
                <select class="form-control" id="speaker" name="speaker" required>
                    <?php
                    require ('../connection.php');
                    $statement = 'SELECT * FROM speaker ';
                    $query = $pdo->query($statement);

                    if ($query->rowCount() > 0)
                    {
                        foreach ($query as $row)
                        {
                            if ($conferencePlan['speaker_id'] == $row['id'])
                            {
                                echo '<option value="'.$row['id'].' selected">'.$row['name'].'&nbsp'.$row['surname'].'</option>' ;
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
