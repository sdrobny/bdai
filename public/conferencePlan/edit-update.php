<?php
/**
 * Created by PhpStorm.
 * User: Szymon
 * Date: 11.11.2018
 * Time: 16:38
 */

session_start();
/* POST to Variables  */


    if ($_SESSION['role'] == 3 || $_SESSION['role' == 2]) {
        //Hmmm...
    } else if ($_SESSION['role'] == 1) {
        header("Location: ../no-permission.php");
        die();
    } else {
        header("Location: ../login.php");
        die();
    }


$id = $_POST['id'];

/* Include Connection*/
require('../connection.php');

/* Do Insert Query */


    $sql = 'UPDATE conference_plan SET conference_id = :conference_id,
            speaker_id = :speaker_id, tittle = :tittle, description = :description, 
             start_date = :start_date, end_date = :end_date
             WHERE id = :id;';

    $dataTime1 = new DateTime($_POST['dateStart']);
    $dateTime2 = new DateTime($_POST['dateEnd']);
    $date1 = $dataTime1->format("Y-m-d H:i:s");
    $date2 = $dateTime2->format("Y-m-d H:i:s");
    //$dateTimeStart = date("Y-m-d H:i:s" , $_POST['dateStart']);
    //$dateTimeEnd = date("Y-m-d H:i:s" , $_POST['dateEnd']);

        echo $_POST['conference'];
        echo $_POST['tittle'];
        echo  $_POST['dateStart'];

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':conference_id', $_POST['conference'] , PDO::PARAM_INT);
    $stmt->bindParam(':speaker_id', $_POST['speaker'], PDO::PARAM_INT);
    $stmt->bindParam(':tittle', $_POST['tittle'] , PDO::PARAM_STR);
    $stmt->bindParam(':description', $_POST['description'], PDO::PARAM_STR);
    $stmt->bindParam(':start_date',$date1 , PDO::PARAM_STR);
    $stmt->bindParam(':end_date', $date2, PDO::PARAM_STR);
    $stmt->bindParam(':id', $_POST['id'], PDO::PARAM_INT);

    $success = $stmt->execute();

    if ($success) {
        $_SESSION['success_msg'] = "Edytowano pomyślnie rekord";
        $_SESSION['rollPlan'] = $_POST['conference'];
        header("Location: /conference/show.php");
    } else {
        $_SESSION['error_msg'] = "Napotkano błąd przy edycji rekordu.";
        $_SESSION['rollPlan'] = $_POST['conference'];
        header("Location: /conference/show.php");
        die();
    }






