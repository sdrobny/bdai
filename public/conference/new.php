<?php
/**
 * Created by PhpStorm.
 * User: Ikki
 * Date: 14.12.2018
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
</head>
<body>
<header class="">
    <h1>Dodawanie Konferencji</h1>
</header>
</header>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a href="list.php" class="btn btn-primary">Powrót</a>
</nav>

<div class="col-xs-12 col-md-6 col-md-push-3 border border-light">


    <form action="new-insert.php" method="POST">

        <div class="row">
            <div class="form-group">
                <label for="tittle">Tytuł</label>
                <input type="text" minlength="3" class="form-control" id="tittle" name="tittle" required/>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <label for="description">Opis</label>
                <input type="text" minlength="1" class="form-control" id="description" name="description" required/>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <label for="address">Adres</label>
                <select class="form-control" id="address" name="address" required/>
                    <?php
                    require ('../connection.php');
                    $statement = 'SELECT * FROM address ';
                    $query = $pdo->query($statement);

                    if ($query->rowCount() > 0)
                    {
                        foreach ($query as $row)
                        {
                            echo '<option value="'.$row['id'].'">'.$row['street']." ".$row['building_number'].
                                " ".$row['city'].'</option>' ;
                        }
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <label for="partner">Partnerzy</label>
                <select name="partner[]" multiple="multiple" class="form-control js-example-basic-multiple" />
                    <?php
                    require ('../connection.php');
                    $statement = 'SELECT * FROM partner ';
                    $query = $pdo->query($statement);

                    if ($query->rowCount() > 0)
                    {
                        foreach ($query as $row)
                        {
                            echo '<option value="'.$row['id'].'">'.$row['name'].'</option>' ;
                        }
                    }
                    ?>
                </select>
                <script type="text/javascript">
                    $(document).ready(function() {
                        $('.js-example-basic-multiple').select2();
                    });
                </script>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <label for="organizers">Organizatorzy</label>
                <select name="organizers[]" multiple="multiple" class="form-control js-example-basic-multiple" required/>
                    <?php
                    require ('../connection.php');
                    $statement = 'SELECT * FROM organizing_committee ';
                    $query = $pdo->query($statement);

                    if ($query->rowCount() > 0)
                    {
                        foreach ($query as $row)
                        {
                            if ($row['surname'] != null)
                            {
                                echo '<option value="'.$row['id'].'">'.$row['name'].'</option>' ;
                            }
                            else
                            {
                                echo '<option value="'.$row['id'].'">'.$row['name'].' '.$row['surname'].'</option>';
                            }
                        }
                    }
                    ?>
                </select>
                <script type="text/javascript">
                    $(document).ready(function() {
                        $('.js-example-basic-multiple').select2();
                    });
                </script>
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
</html>
