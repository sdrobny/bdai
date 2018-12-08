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
    $statement = 'SELECT * FROM user WHERE id = "'.$_POST['id'].'";';
    $query = $pdo->query($statement);
    if ($query->rowCount() > 0 ) {
        $user = $query->fetch();
    }
}
?>

<html>
<head>
    <?php include('../head.html'); ?>
</head>
<body>
<header class="">
    <h1>Edycja Użytkownika</h1>
    <?php  include('../topbar.php') ?>
</header>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a href="list.php" class="btn btn-primary">Powrót</a>
</nav>

<div class="col-xs-12 col-md-6 col-md-push-3 border border-light">


    <form action="edit-update.php" method="post">

        <input type="hidden" value="<?php echo $user['id'] ?>" name="id">
        <input type="hidden" value="<?php echo $user['username'] ?>" name="previousUsername">

        <div class="row">
            <div class="form-group">
                <label for="username">Login</label>
                <input type="text" minlength="3" class="form-control" id="username" name="username" value="<?php echo $user['username'] ?>">
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <label for="passw">Hasło</label>
                <input type="password" minlength="1" class="form-control" id="passw" name="passw" value="">
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <label for="email">Adres E-mail</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="np. adres@email.com" value="<?php echo $user['email'] ?>">
            </div>
        </div>

        <div class="row col-md-12 text-center">
            <div class="form-group">
                <label for="roleSelect">Uprawnienia</label>
                <select class="form-control" id="roleSelect" name="admin">
                    <option value="1" <?php if($user['admin'] == 1) echo "selected" ?>>User</option>
                    <option value="2" <?php if($user['admin'] == 2) echo "selected" ?>>Admin</option>
                    <option value="3" <?php if($user['admin'] == 3) echo "selected" ?>>Super-Admin</option>
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
    } else if ($_SESSION['role'] == 2) {
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
