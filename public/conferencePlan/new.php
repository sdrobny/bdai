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
?>

<html>
<head>
    <?php include('../head.html'); ?>
</head>
<body>
<header class="">
    <h1>Dodawanie podwydarzenia konferencji</h1>
</header>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <?php
            echo "<form action='/conference/show.php' method='POST'>
                    <input type='hidden' name='id' value='".$_POST['id']."'>
                    <input type='submit' class='btn btn-info' value='Powrót'></form>"
    ?>
</nav>

<div class="col-xs-12 col-md-6 col-md-push-3 border border-light">


    <form action="new-insert.php" method="POST" enctype="multipart/form-data">

        <div class="row">
            <div class="form-group">
                <label for="tittle">Tytuł</label>
                <input type="text" minlength="3" class="form-control" id="tittle" name="tittle">
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <label for="dateStart">Data rozpoczęcia</label>
                <input type="datetime-local"  class="form-control" id="dateStart" name="dateStart">
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <label for="dateEnd">Data zakończenia</label>
                <input type="datetime-local"  class="form-control" id="dateEnd" name="dateEnd">
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <label for="description">Opis</label>
                <input type="text" minlength="3" class="form-control" id="description" name="description">
            </div>
        </div>

                <input type="hidden" class="form-control" id="conference" name="conference" value="<?php echo $_POST['id']?>">
                <!--<select class="form-control" id="conference" name="conference" required>
                    <?php/*
                        require ('../connection.php');
                        $statement = 'SELECT * FROM conference ';
                        $query = $pdo->query($statement);

                        if ($query->rowCount() > 0)
                        {
                            foreach ($query as $row)
                            {
                                echo '<option value="'.$row['id'].'">'.$row['tittle'].'</option>' ;
                            }
                        }*/
                    ?>
                </select> -->

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
                            echo '<option value="'.$row['id'].'">'.$row['name'].'&nbsp'.$row['surname'].'</option>' ;
                        }
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="row">
            <input type="submit" class="btn btn-success" value="Dodaj">
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
<script>
</script>
</html>
