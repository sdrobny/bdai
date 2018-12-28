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
    <h1>Dodawanie Adresu</h1>
</header>
</header>

<?php
if (isset($_SESSION['error_msg']) && $_SESSION['error_msg'] != null) {
    echo '<div class="alert alert-danger">' . $_SESSION['error_msg'] . '</div>';
    $_SESSION['error_msg'] = null;
}

if (isset($_SESSION['success_msg']) && $_SESSION['success_msg'] != null) {
    echo '<div class="alert alert-success">' . $_SESSION['success_msg'] . '</div>';
    $_SESSION['success_msg'] = null;
}
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a href="list.php" class="btn btn-primary">Powrót</a>
</nav>

<div class="col-xs-12 col-md-6 col-md-push-3 border border-light">


    <form action="new-insert.php" method="POST">

        <div class="row">
            <div class="form-group">
                <label for="street">Ulica</label>
                <input type="text" minlength="3" class="form-control" id="street" name="street" required/>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <label for="buildingNumber">Numer budynku</label>
                <input type="text" minlength="1" class="form-control" id="buildingNumber" name="buildingNumber" required/>
            </div>
        </div>

        <div class="row">
            <div class="Miasto">
                <label for="city">MIasto</label>
                <input type="text" minlength="3" class="form-control" id="city" name="city" required/>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <label for="building_name">Nazwa Budynku</label>
                <input type="text" minlength="3" class="form-control" id="building_name" name="building_name">
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <label for="post_code">Kod Pocztowy</label>
                <input type="text" minlength="3" class="form-control" id="post_code" name="post_code" required/>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <label for="phone_number">Telefon kontaktowy</label>
                <input type="text" minlength="3" class="form-control" id="phone_number" name="phone_number" >
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
