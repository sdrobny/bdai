<?php
/**
 * Created by PhpStorm.
 * User: Szymon
 * Date: 11.11.2018
 * Time: 16:38
 */

session_start();
/* POST to Variables  */


/* Include Connection */
require ('../connection.php');

/* Try Upload File */

if(isset($_FILES['image'])){

    $errors= array();
    $file_name = $_FILES['image']['name'];
    $file_size =$_FILES['image']['size'];
    $file_tmp =$_FILES['image']['tmp_name'];
    $file_type=$_FILES['image']['type'];
    $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));

    $expensions= array("jpeg","jpg","png");


    if(empty($errors)==true){
        if(file_exists("../upload/".$file_name)) $file_name = $file_name."(2)";
        move_uploaded_file($file_tmp,"../upload/".$file_name);
        $imgpath = "../upload/".$file_name;
    }else{
        $_SESSION['error_msg'] = "Błąd przy uploadzie pliku";
    }
}


echo("../upload/".$file_name);


if ($imgpath != "") {


    $sql = 'INSERT INTO speaker (name, surname, image, specialization) VALUES (:name, :surname, :image, :specialization)';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $_POST['name'] , PDO::PARAM_STR);
    $stmt->bindParam(':surname', $_POST['surname'] , PDO::PARAM_STR);
    $stmt->bindParam(':image', $imgpath , PDO::PARAM_STR);
    $stmt->bindParam(':specialization', $_POST['specialization'] , PDO::PARAM_STR);


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
else header("Location: asdasdasf");








