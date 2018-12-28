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


/* Include Connection */
require ('../connection.php');


/* Do Insert Query */


    $sql = 'INSERT INTO conference_plan (conference_id, speaker_id, tittle , description , start_date , end_date ) 
    VALUES (:conference_id , :speaker_id, :tittle, :description,  :start_date, :end_date )';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':conference_id', $_POST['conference'] , PDO::PARAM_INT);
    $stmt->bindParam(':speaker_id', $_POST['speaker'], PDO::PARAM_INT);
    $stmt->bindParam(':tittle', $_POST['tittle'] , PDO::PARAM_STR);
    $stmt->bindParam(':description', $_POST['description'], PDO::PARAM_STR);
    $stmt->bindParam(':start_date', $_POST['dateStart'], PDO::PARAM_STR);
    $stmt->bindParam(':end_date', $_POST['dateEnd'], PDO::PARAM_STR);

    $stmt->execute();
    $success = true;

    if($success)
    {
        $_SESSION['success_msg'] = "Dodano pomyślnie rekord";
        $_SESSION['rollPlan'] = $_POST['conference'];
        header("Location: /conference/show.php");
        die();
        //echo  $stmt->queryString;
    }
    else
    {
        $_SESSION['error_msg'] = "Napotkano błąd przy dodawaniu rekordu.";
        $_SESSION['rollPlan'] = $_POST['conference'];
        header("Location: /conference/show.php");
        die();
    }






