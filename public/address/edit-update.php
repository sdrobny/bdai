<?php
/**
 * Created by PhpStorm.
 * User: Szymon
 * Date: 11.11.2018
 * Time: 16:38
 */

session_start();
/* POST to Variables  */
if  (!isset($_POST['street']) || $_POST['street'] == null ) {
    header("Location: new.php");
    die();
}

$id = $_POST['id'];

/* Include Connection*/
require('../connection.php');

/* Check if username already exists
$exists = false;
if ($_POST['previousUsername'] != $username) {
    $statement = 'SELECT * FROM user WHERE username = "' . $username . '";';
    $query = $pdo->query($statement);
    if ($query->rowCount() > 0) {
        $_SESSION['error_msg'] = "Użytkownik juz istnieje";
        $exists = true;
        header("Location: list.php");
        die();
    }

}
*/

/* Do Insert Query */

if ($exists == false) {

    $sql = 'UPDATE address SET street = :street, building_name = :building_name, city = :city, post_code = :post_code, phone_number = :phone_number WHERE id = :id;';
    //$sql = 'INSERT INTO address (street, building_name, city, post_code, phone_number) VALUES (:street, :building_name, :city, :post_code, :phone_number)';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':street', $_POST['street'] , PDO::PARAM_STR);
    $stmt->bindParam(':building_name', $_POST['building_name'] , PDO::PARAM_STR);
    $stmt->bindParam(':city', $_POST['city'], PDO::PARAM_STR);
    $stmt->bindParam(':post_code', $_POST['post_code'], PDO::PARAM_STR);
    $stmt->bindParam(':phone_number', $_POST['phone_number'], PDO::PARAM_STR);
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




