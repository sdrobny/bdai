<?php
/**
 * Created by PhpStorm.
 * User: Szymon
 * Date: 11.11.2018
 * Time: 20:44
 */

session_start();
    if ($_SESSION['role'] == 3 || $_SESSION['role' == 2]) {
        //Hmmm...
    } else if ($_SESSION['role'] == 1) {
        header("Location: ../no-permission.php");
        die();
    } else {
        header("Location: ../login.php");
        die();
    }


require ('../connection.php');
//Chceck if used

    echo $_POST['id'].'<br/>';
    echo $_POST['idc'];

    $id = $_POST['id'];
    $sql = "DELETE FROM conference_plan WHERE id =  :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
    $stmt->execute();

    session_start();
    $_SESSION['success_msg'] = "Pomyślnie usunięto rekord";
    $_SESSION['rollPlan'] = $_POST['idc'];
    header("Location: /conference/show.php");
    die();

