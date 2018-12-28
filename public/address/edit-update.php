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
if  (!isset($_POST['street']) || $_POST['street'] == null ) {
    header("Location: new.php");
    die();
}

if (!preg_match('/^\d/', $_POST['buildingNumber']))
{
    header("Location: list.php");
    $_SESSION['error_msg'] = "Błędny numer budynku(pierwsza zawsze musi być cyfra)";
    die();
}

if (!preg_match('/^[0-9]{2}[-][0-9]{3}$/' , $_POST['post_code']))
{
    header("Location: list.php");
    $_SESSION['error_msg'] = "Błędny kod pocztowy";
    die();
}

if (!is_numeric($_POST['phone_number']))
{
    header("Location: list.php");
    $_SESSION['error_msg'] = "Błędny format numeru telefonu";
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

    $sql = 'UPDATE address SET street = :street, building_name = :building_name, city = :city,
      post_code = :post_code, phone_number = :phone_number, building_number = :building_number WHERE id = :id;';
    //$sql = 'INSERT INTO address (street, building_name, city, post_code, phone_number) VALUES (:street, :building_name, :city, :post_code, :phone_number)';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':street', $_POST['street'] , PDO::PARAM_STR);
    $stmt->bindParam(':building_name', $_POST['building_name'] , PDO::PARAM_STR);
    $stmt->bindParam(':city', $_POST['city'], PDO::PARAM_STR);
    $stmt->bindParam(':post_code', $_POST['post_code'], PDO::PARAM_STR);
    $stmt->bindParam(':phone_number', $_POST['phone_number'], PDO::PARAM_STR);
    $stmt->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
    $stmt->bindParam(':building_number' , $_POST['buildingNumber'], PDO::PARAM_STR);

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




