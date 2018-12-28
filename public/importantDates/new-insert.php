<?php
/**
 * Created by PhpStorm.
 * User: Szymon
 * Date: 11.11.2018
 * Time: 16:38
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


/* POST to Variables  */


/* Include Connection */
require ('../connection.php');


/* Do Insert Query */

if ($exists == false) {


    $sql = 'INSERT INTO important_dates (conference_id, date, description) VALUES (:conference_id, :date, :description)';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':conference_id', $_POST['conference'] , PDO::PARAM_INT);
    $stmt->bindParam(':date', $_POST['date'] , PDO::PARAM_STR);
    $stmt->bindParam(':description', $_POST['description'], PDO::PARAM_STR);

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




