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
                <h1>
                    Konferencje - Zaloguj się
                </h1>
            </div>
            <hr>

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

        $statement = 'SELECT * FROM user WHERE username = "'.$username.'";';
        require ('connection.php');
        $query=$pdo->query($statement);

        if ($query->rowCount() > 0 )
        {
            $row = $query->fetch(PDO::FETCH_ASSOC);

            if(password_verify($_POST['_password'],$row['password']))
            {
                $_SESSION['username'] = $row['username'];
                $_SESSION['role'] = $row['admin'];
                $_SESSION['logged'] = 1;
                echo "<script>location.href='index.php'</script>";
            }
            else
            {
                echo '<div class="alert alert-danger  col-sm-12 text-center">Niepoprawne dane logowania</div>';
            }
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
