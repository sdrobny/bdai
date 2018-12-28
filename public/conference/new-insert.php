<?php
/**
 * Created by PhpStorm.
 * User: Ikki
 * Date: 16.12.2018
 * Time: 14:00
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


    try {
        $pdo->beginTransaction();


            $sql = 'INSERT INTO conference (tittle, description, address_id) 
            VALUES (:tittle , :description, :address_id)';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':tittle', $_POST['tittle'] , PDO::PARAM_STR);
            $stmt->bindParam(':description', $_POST['description'], PDO::PARAM_STR);
            $stmt->bindParam(':address_id', $_POST['address'] , PDO::PARAM_INT);
            $stmt->execute();

            $idConf = $pdo->lastInsertId();

        if( isset ($_POST['partner']))
        {
            $data = $_POST['partner'];
            foreach ($data as $item)
            {
                $sq = 'INSERT INTO conference_partner (conference_id, partner_id) VALUES (:conf_id,:part_id)';
                $stmt = $pdo->prepare($sq);
                $stmt->bindParam('conf_id' , $idConf , PDO::PARAM_INT);
                $stmt->bindParam('part_id' , $item , PDO::PARAM_INT);
                $stmt->execute();
            }
        }

        if( isset ($_POST['organizers']))
        {
            $data = $_POST['organizers'];
            foreach ($data as $item)
            {
                $sq = 'INSERT INTO conference_organizing_committee (conference_id, organizing_committee_id) VALUES (:conf_id,:org_id)';
                $stmt = $pdo->prepare($sq);
                $stmt->bindParam('conf_id' , $idConf , PDO::PARAM_INT);
                $stmt->bindParam('org_id' , $item , PDO::PARAM_INT);
                $stmt->execute();
            }
        }

        $pdo->commit();
        $_SESSION['success_msg'] = "Pomyślnie dodano rekord";
        header("Location: list.php");
        die();
    }
    catch (Exception $e)
    {
        $pdo->rollBack();
        $_SESSION['error_msg'] = "Błąd podczas dodawania rekordu";
        header("Location: list.php");
        die();
    }



