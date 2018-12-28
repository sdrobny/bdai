<?php
/**
 * Created by PhpStorm.
 * User: Ikki
 * Date: 16.12.2018
 * Time: 13:59
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

//Delete

    // Usuwanie important_dates powiązanych z konferencją
try {
    $pdo->beginTransaction();

    $id = $_POST['id'];
    $sql = "DELETE FROM important_dates WHERE conference_id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id' , $id , PDO::PARAM_INT);
    $stmt->execute();

    // Usuwanie conference_plan powiązanych z konferencją
    $sql = "DELETE FROM conference_plan WHERE conference_id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id' , $id , PDO::PARAM_INT);
    $stmt->execute();

    $sql = "DELETE FROM conference WHERE id =  :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
    $stmt->execute();

    $pdo->commit();
    session_start();
    $_SESSION['success_msg'] = "Pomyślnie usunięto rekord";
    header("Location: list.php");
    die();
}
catch (Exception $e)
{
    $pdo->rollBack();
    session_start();
    $_SESSION['error_msg'] = "Błąd podczas usunięcia rekordu";
    header("Location: list.php");
    die();
}


