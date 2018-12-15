<?php
/**
 * Created by PhpStorm.
 * User: Szymon Drobny
 * Date: 15.12.2018
 * Time: 15:23
 */

session_start();
$_SESSION['username'] = 'guest';
$_SESSION['role'] = 1;
$_SESSION['logged'] = 0;
header('Location: index.php');