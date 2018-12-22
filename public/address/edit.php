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
    /* Check if username already exists */
    require ('../connection.php');
    $exists = false;
    $statement = 'SELECT * FROM address WHERE id = "'.$_POST['id'].'";';
    $query = $pdo->query($statement);
    if ($query->rowCount() > 0 ) {
        $address = $query->fetch();
    }
}
?>

<html>
<head>
    <?php include('../head.html'); ?>
</head>
<body>
<header class="">
    <h1>Edycja adresu</h1>
    <?php  include('../topbar.php') ?>
</header>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a href="list.php" class="btn btn-primary">Powrót</a>
</nav>

<div class="col-xs-12 col-md-6 col-md-push-3 border border-light">


    <form action="edit-update.php" method="post">

        <input type="hidden" value="<?php echo $address['id'] ?>" name="id">

        <div class="row">
            <div class="form-group">
                <label for="street">Ulica</label>
                <input type="text" minlength="3" class="form-control" id="street" name="street" value="<?php echo $address['street']; ?>">
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <label for="buildingNumber">Numer budynku</label>
                <input type="text" minlength="1" class="form-control" id="buildingNumber" name="buildingNumber" value="<?php echo $address['building_number']; ?>">
            </div>
        </div>

        <div class="row">
            <div class="Miasto">
                <label for="city">Miasto</label>
                <input type="text" minlength="3" class="form-control" id="city" name="city" value="<?php echo $address['city']; ?>">
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <label for="building_name">Nazwa Budynku</label>
                <input type="text" minlength="3" class="form-control" id="building_name" name="building_name" value="<?php echo $address['building_name']; ?>">
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <label for="post_code">Kod Pocztowy</label>
                <input type="text" minlength="3" class="form-control" id="post_code" name="post_code" value="<?php echo $address['post_code']; ?>">
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <label for="phone_number">Telefon kontaktowy</label>
                <input type="tel" minlength="3" class="form-control" id="phone_number" name="phone_number" value="<?php echo $address['phone_number']; ?>">
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
