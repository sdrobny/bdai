<?php
/**
 * Created by PhpStorm.
 * User: Szymon
 * Date: 11.11.2018
 * Time: 20:44
 */
require ('../connection.php');
$id = $_POST['id'];
$sql = "DELETE FROM user WHERE id =  :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
$stmt->execute();

session_start();
$_SESSION['success_msg'] = "Pomyślnie usunięto rekord";
header("Location: list.php");
die();
