<?php
session_start();
error_reporting(0);
?>
<html>
<head>
	<?php include('head.html'); ?>
</head>
<body>

<?php
    if ($_SESSION['logged'] == 1)
    {
        header("Location: index.php");
		die();
    }
?>

<div class="wrapper">
    <section class="page-section color">
        <div class="container">

            <div class="section-title">
                <h2>
                    <div class="text-center">Konferencje - Logowanie</div>
					<hr>
                </h2>
            </div>

            <!-- Login form -->
            <form action="" method="post" class="af-form row">


                <div class="col-sm-12 af-outer af-required">
                    <div class="form-group af-inner">
                        <input type="text" id="username" name="_username" placeholder="Login" value="" required="required" autocomplete="username"   class="form-control dark placeholder"/>
                    </div>
                </div>

                <div class="col-sm-12 af-outer af-required">
                    <div class="form-group af-inner">
                        <input type="password" id="password" name="_password" required="required" autocomplete="current-password" placeholder="Password" class="form-control placeholder"/>
                    </div>
                </div>

                <br/>
                <br/>

                <div class="col-sm-12 af-outer af-required text-center">
                    <div class="form-group af-inner">
                        <input  type="submit"  name="_submit" value="Zaloguj się"  class="form-button form-button-submit btn btn-theme btn-theme-lg btn-theme-transparent form-submit-button" id="submit_btn"/>
                    </div>
                </div>

            </form>
        </div>
    </section>

    <?php
		
		if (isset($_POST['_username']) && isset($_POST['_password']))
        {
			
			$username = $_POST['_username'];
            $password = $_POST['_password'];
            $statement = 'SELECT * FROM user WHERE username = "'.$username.'" AND password = "'.$password.'";';
            
			require ('connection.php');
            $query=$pdo->query($statement);

            if ($query->rowCount() == 1 )
                {
                    $row = $query->fetch(PDO::FETCH_ASSOC);
                     $_SESSION['username'] = $row['username'];
                     $_SESSION['role'] = $row['admin'];
                     $_SESSION['logged'] = 1;
                    echo "<script>location.href='index.php';</script>";
                }
            else
                {
                    echo '<div class="alert alert-danger  col-sm-12 text-center">Niepoprawne dane logowania</div>';
                }
        }
    ?>

</div>
</body>
</html>
