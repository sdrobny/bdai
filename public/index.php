<?php
        session_start();
		error_reporting(0);
        if (isset($_POST['log']))
        {
            $_SESSION['username'] = 'guest';
            $_SESSION['role'] = 1;
            $_SESSION['logged'] = 0;
        }
?>
<html>
<head>
	<?php include('head.html'); ?>
</head>
<body>
    <h1>Konferencje</h1>
    <br>
    <br>
<?php
        session_start();
        if (!isset($_SESSION['username'])) $_SESSION['username'] = 'guest';
        if (!isset($_SESSION['role'])) $_SESSION['role'] = 1;
        if (!isset($_SESSION['logged'])) $_SESSION['logged'] = 0;

        if ($_SESSION['username'] == 'guest')
        {
            header('Location: login.php');
        }
		else
		{
            header('Location: panel.php');
		}

?>

</body>
</html>
