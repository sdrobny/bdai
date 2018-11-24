<?php
/**
 * Created by PhpStorm.
 * User: Szymon
 * Date: 11.11.2018
 * Time: 16:38
 */

session_start();
/* POST to Variables  */
if  (!isset($_POST['username']) || $_POST['username'] == null ) {
    header("Location: list.php");
    die();
} else $username = $_POST['username'];

if  (!isset($_POST['passw']) || $_POST['passw'] == null ) {
    header("Location: list.php");
    die();
} else $passw = $_POST['passw'];

if  (!isset($_POST['email']) || $_POST['email'] == null ) {
    header("Location: list.php");
    die();
} else $email = $_POST['email'];

if  (!isset($_POST['admin']) || $_POST['admin'] == null ) {
    header("Location: list.php");
    die();
} else $admin = $_POST['admin'];

$id = $_POST['id'];

/* Include Connection*/
require('../connection.php');

/* Check if username already exists */
$exists = false;
if ($_POST['previousUsername'] != $username) {
    $statement = 'SELECT * FROM user WHERE username = "' . $username . '";';
    $query = $pdo->query($statement);
    if ($query->rowCount() > 0) {
        $_SESSION['error_msg'] = "Użytkownik juz istnieje";
        $exists = true;
        header("Location: list.php");
        die();
    }

}
/* Do Insert Query */

if ($exists == false) {

    /*
    $sql = "UPDATE user SET username = :username , password = :password , email = :email , admin = :admin  WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $success = $stmt->execute($data);
    */

    $sql = 'UPDATE user SET username = :username , password = :passw , email = :email ,  admin = :admin WHERE id = :id;';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':passw', $passw, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':admin', $admin, PDO::PARAM_INT);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $success = $stmt->execute();

    if ($success) {
        $_SESSION['success_msg'] = "Edytowano pomyślnie rekord";
        header("Location: list.php");
        die();
    } else {
        $_SESSION['error_msg'] = "Napotkano błąd przy edycji rekordu.";
        header("Location: list.php");
        die();
    }

}




