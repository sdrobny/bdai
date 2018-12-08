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
    header("Location: new.php");
    die();
} else $username = $_POST['username'];

/* if  (!isset($_POST['password']) || $_POST['password'] == null ) {
    header("Location: new.php");
    die();
} else */ $passw = $_POST["passw"];

if  (!isset($_POST['email']) || $_POST['email'] == null ) {
    header("Location: new.php");
    die();
} else $email = $_POST['email'];

if  (!isset($_POST['admin']) || $_POST['admin'] == null ) {
    header("Location: new.php");
    die();
} else $admin = $_POST['admin'];

/* Include Connection*/
require ('../connection.php');

/* Check if username already exists */
$exists = false;
$statement = 'SELECT * FROM user WHERE username = "'.$username.'";';
$query = $pdo->query($statement);
if ($query->rowCount() > 0 ) {
    $_SESSION['error_msg'] = "Użytkownik juz istnieje";
    $exists = true;
    header("Location: new.php");
    die();
}

/* Do Insert Query */

if ($exists == false) {

    $data = [
        'username' => $username,
        'passw' => $passw,
        'email' => $email,
        'admin' => $admin
    ];

    //$password = 'xyz';

    $sql = 'INSERT INTO user (username, password, email, admin) VALUES (:username, :passw, :email, :admin)';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username , PDO::PARAM_STR);
    $stmt->bindParam(':passw', password_hash($passw,PASSWORD_BCRYPT) , PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':admin', $admin, PDO::PARAM_INT);

    $stmt->execute();
    $success = true;

    if($success)
    {
        $_SESSION['success_msg'] = "Dodano pomyślnie rekord";
        header("Location: list.php");
        //die();
        //echo  $stmt->queryString;
    }
    else
    {
        $_SESSION['error_msg'] = "Napotkano błąd przy dodawaniu rekordu.";
        header("Location: list.php");
        die();
    }

}




