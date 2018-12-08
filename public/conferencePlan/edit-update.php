<?php
/**
 * Created by PhpStorm.
 * User: Szymon
 * Date: 11.11.2018
 * Time: 16:38
 */

session_start();
/* POST to Variables  */

$id = $_POST['id'];

/* Include Connection*/
require('../connection.php');

/* Do Insert Query */

if ($exists == false) {

    $sql = 'UPDATE important_dates SET conference_id = :conference_id,
            speaker_id = :speaker_id, tittle = :tittle, description = :description, 
             start_date = :start_date, end_date = :end_date
             WHERE id = :id;';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':conference_id', $_POST['conference'] , PDO::PARAM_INT);
    $stmt->bindParam(':speaker_id', $_POST['speaker'], PDO::PARAM_INT);
    $stmt->bindParam(':tittle', $_POST['tittle'] , PDO::PARAM_STR);
    $stmt->bindParam(':description', $_POST['description'], PDO::PARAM_STR);
    $stmt->bindParam(':start_date', $_POST['dateStart'], PDO::PARAM_STR);
    $stmt->bindParam(':end_date', $_POST['dateEnd'], PDO::PARAM_STR);
    $stmt->bindParam(':id', $_POST['id'], PDO::PARAM_INT);

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




