<?php
/**
 * Created by PhpStorm.
 * User: Ikki
 * Date: 02.11.2018
 * Time: 12:25
 */

    $host='localhost';
    $user='root';
    $password='';
    $database='bdai';
    $dns="mysql:host=".$host.";dbname=".$database;
    $pdo= new PDO($dns,$user,$password);

?>