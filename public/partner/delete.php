<?php
/**
 * Created by PhpStorm.
 * User: Szymon
 * Date: 11.11.2018
 * Time: 20:44
 */
require ('../connection.php');
//Chceck if used
$id = $_POST['id'];
$statement = 'SELECT * FROM conference_partner WHERE partner_id = '.$_POST['id'];
$query = $pdo->query($statement);






//Delete
if ($query->rowCount() == 0) {
    $id = $_POST['id'];
    $sql = "DELETE FROM partner WHERE id =  :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
    $stmt->execute();

    session_start();
    $_SESSION['success_msg'] = "Pomyślnie usunięto rekord";
    header("Location: list.php");
    die();
}
else
{
    session_start();
    $_SESSION['error_msg'] = "Rekord jest powiązany relacją, nie można go usunąć";
    header("Location: list.php");
    die();
}