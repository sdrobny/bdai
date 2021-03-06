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
$id = $_POST['id'];

/* Include Connection*/
require('../connection.php');

/* Upload if new photo
*/

if (isset($_FILES['image'])) {

    $errors = array();
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    $file_ext = strtolower(end(explode('.', $_FILES['image']['name'])));

    $expensions = array("jpeg", "jpg", "png");

    if (!file_exists($_FILES['image']['tmp_name']) || !is_uploaded_file($_FILES['image']['tmp_name'])) {
        $imgpath = $_POST['imgpath'];
    } else {

        if (file_exists("../upload/" . $file_name)) $file_name = $file_name . "(2)";
        move_uploaded_file($file_tmp, "../upload/" . $file_name);
        $imgpath = "../upload/" . $file_name;

    }


}

/* Do Insert Query */

if ($imgpath != "") {

    $sql = 'UPDATE partner SET name = :name, image = :image, website = :website WHERE id = :id;';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
    $stmt->bindParam(':image', $imgpath, PDO::PARAM_STR);
    $stmt->bindParam(':website', $_POST['website'], PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);


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




