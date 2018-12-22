<?php
/**
 * Created by PhpStorm.
 * User: Ikki
 * Date: 16.12.2018
 * Time: 13:59
 */

require ('../connection.php');

//Delete

    // Usuwanie important_dates powiązanych z konferencją
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

    session_start();
    $_SESSION['success_msg'] = "Pomyślnie usunięto rekord";
    header("Location: list.php");
    die();