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
    <h1>Dodawanie Użytkownika</h1>
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
                <label for="username">Login</label>
                <input type="text" minlength="3" class="form-control" id="username" name="username" required/>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <label for="password">Hasło</label>
                <input type="password" minlength="1" class="form-control" id="password" name="passw" required/>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <label for="email">Adres E-mail</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="np. adres@email.com" required/>
            </div>
        </div>

        <div class="row col-md-12 text-center">
            <div class="form-group">
                <label for="roleSelect">Uprawnienia</label>
                <select class="form-control" id="roleSelect" name="admin">
                    <option value="1">User</option>
                    <option value="2">Admin</option>
                    <option value="3">Super-Admin</option>
                </select>
            </div>
        </div>

        <div class="row">
            <input type="submit" class="btn btn-success" value="Dodaj">
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
