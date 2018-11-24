<?php
        session_start();
		error_reporting(0);
        if (isset($_POST['log']))
        {
            $_SESSION['username'] = 'guest';
            $_SESSION['role'] = 1;
            $_SESSION['logged'] = 0;
            echo "<script>location.href='index.php';</script>";
        }
?>
<html>
<head>
	<?php include('head.html'); ?>
</head>
<body>


<?php
        session_start();
        if (!isset($_SESSION['username'])) $_SESSION['username'] = 'guest';
        if (!isset($_SESSION['role'])) $_SESSION['role'] = 1;
        if (!isset($_SESSION['logged'])) $_SESSION['logged'] = 0;

        if ($_SESSION['username'] != 'guest')
        {
            
			echo '<div class="col-sm-12 com-md-4 alert alert-success ">Zalogowano</div>';
			echo '<div class="col-sm-12 com-md-4 m-2">Zalogowany: '.$_SESSION['username'].'</div>';
            echo '<div class="col-sm-12 com-md-4 ">Poziom uprawnień: '.$_SESSION['role'].'</div>';
			
			//Logout   
			echo(
			'</br>
			<div class="col-sm-12">
			<form method="post">
			<input type="hidden" , name="log" value="1"/>
			<input type="submit" value="Wyloguj" class="btn btn-danger">
			</form>
			<div class="kangaroos"><img src="img/kangaroo.jpg"></div>
			</div>
			');
			
			
        }
		else
		{
		    echo '<div class="col-sm-12 com-md-4 ">Odwiedzasz witrynę jako gość</div>';
			echo '<hr>';
			echo '<a href="login.php" class="btn btn-success">Zaloguj</div>';
		}

?>

</body>
</html>
