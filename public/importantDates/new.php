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
    <h1>Dodawanie Ważnej daty</h1>
    <?php  include('../topbar.php') ?>
</header>
</header>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a href="list.php" class="btn btn-primary">Powrót</a>
</nav>

<div class="col-xs-12 col-md-6 col-md-push-3 border border-light">


    <form action="new-insert.php" method="POST" enctype="multipart/form-data">

        <div class="row">
            <div class="form-group">
                <label for="date">Data</label>
                <input type="date"  class="form-control" id="date" name="date">
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <label for="description">Opis</label>
                <input type="text" minlength="3" class="form-control" id="description" name="description">
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
                                echo '<option value="'.$row['id'].'">'.$row['tittle'].'</option>' ;
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
    if ($_SESSION['role'] == 1) {
        header("Location: ../login.php");
        die();
    }
    ?>
</div>
</body>
<script>
</script>
</html>
