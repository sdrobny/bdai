<?php
/**
 * Created by PhpStorm.
 * User: Szymon
 * Date: 07.11.2018
 * Time: 20:03
 */
session_start();
if (!isset($_SESSION['username'])) $_SESSION['username'] = 'guest';
if (!isset($_SESSION['role'])) $_SESSION['role'] = 1;
if (!isset($_SESSION['logged'])) $_SESSION['logged'] = 0;
if (!isset($_POST['id'])) {
    header("Location: list.php");
    die();
}
else {
    /* Get partner */
    require ('../connection.php');
    $exists = false;
    $statement = 'SELECT * FROM conference WHERE id = "'.$_POST['id'].'";';
    $query = $pdo->query($statement);
    if ($query->rowCount() > 0 ) {
        $conference = $query->fetch();
    }
    else header("Location: list.php");
}
?>

<html>
<head>
    <?php include('../head.html'); ?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

</head>
<body>
<header class="">
    <h1>Edycja Konferencji</h1>
</header>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a href="list.php" class="btn btn-primary">Powrót</a>
</nav>

<div class="col-xs-12 col-md-6 col-md-push-3 border border-light">


    <form action="edit-update.php" method="post" enctype="multipart/form-data">

        <input type="hidden" value="<?php echo $conference['id'] ?>" name="id" >

        <div class="row">
            <div class="form-group">
                <label for="tittle">Tytuł konferencji</label>
                <input type="text"  class="form-control" id="date" name="tittle" value="<?php echo $conference['tittle']; ?>" required/>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <label for="description">Opis</label>
                <input type="text" minlength="3" class="form-control" id="description" name="description" value="<?php echo $conference['description'] ?>" required/>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <label for="address">Adres</label>
                <select class="form-control" id="address" name="address" required/>
                    <?php
                    require ('../connection.php');
                    $statement = 'SELECT * FROM address ';
                    $query = $pdo->query($statement);

                    if ($query->rowCount() > 0)
                    {
                        foreach ($query as $row)
                        {
                            if ($conference['address_id'] == $row['id'])
                            {
                                echo '<option selected value="'.$row['id'].' ">'.$row['street'].' '.$row['building_number'].'</option>' ;
                            }
                            else
                            {
                            echo '<option value="'.$row['id'].'">'.$row['tittle'].'</option>' ;
                            }
                        }
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <label for="partner">Partnerzy</label>
                <select  class="form-control js-example-basic-multiple" name="partner[]" multiple="multiple" >
                    <?php
                    require ('../connection.php');
                    $statement = 'SELECT * FROM conference_partner WHERE conference_id = '.$conference['id'];
                    $query = $pdo->query($statement);

                    if ($query->rowCount() > 0)
                    {
                        $partnerArray = [];
                        foreach ($query as $row)
                        {
                            $stat2 = 'SELECT * FROM partner WHERE id = '.$row['partner_id'];
                            $qr2 = $pdo ->query($stat2);
                            $rr = $qr2->fetch();
                            echo '<option value="'.$rr['id'].'" selected>'.$rr['name'].'</option>' ;
                            array_push($partnerArray,$rr['id']);
                        }

                        $stat2 = 'SELECT * FROM partner';
                        $qr2 = $pdo->query($stat2);
                        foreach ($qr2 as $rr)
                        {
                            if (!in_array($rr['id'],$partnerArray))
                            {
                                echo '<option value="'.$rr['id'].'" >'.$rr['name'].'</option>' ;
                            }
                        }
                    }
                    else
                    {
                        $stat2 = 'SELECT * FROM partner';
                        $qr2 = $pdo->query($stat2);
                        foreach ($qr2 as $rr)
                        {
                                echo '<option value="'.$rr['id'].'" >'.$rr['name'].'</option>' ;
                        }
                    }
                    ?>
                </select>

                <script type="text/javascript">
                    $(document).ready(function() {
                        $('.js-example-basic-multiple').select2();
                    });
                </script>
            </div>
        </div>

        <div class="row">
            <div class="form-group">
                <label for="organizers">Organizatorzy</label>
                <select name="organizers[]" multiple="multiple" class="form-control js-example-basic-multiple" required/>
                    <?php
                    require ('../connection.php');
                    $statement = 'SELECT * FROM conference_organizing_committee WHERE'.$conference['id'];
                    $query = $pdo->query($statement);

                    if ($query->rowCount() > 0)
                    {
                        $partnerArray = [];
                        foreach ($query as $row)
                        {
                            $stat2 = 'SELECT * FROM organizing_committee WHERE id = '.$row['organizing_committee_id'];
                            $qr2 = $pdo ->query($stat2);
                            $rr = $qr2->fetch();
                            echo '<option value="'.$rr['id'].'" selected>'.$rr['name'].'</option>' ;
                            array_push($partnerArray,$rr['id']);
                        }

                        $stat2 = 'SELECT * FROM organizing_committee';
                        $qr2 = $pdo->query($stat2);
                        foreach ($qr2 as $rr)
                        {
                            if (!in_array($rr['id'],$partnerArray))
                            {
                                echo '<option value="'.$rr['id'].'" >'.$rr['name'].'</option>' ;
                            }
                        }
                    }
                    else
                    {
                        $stat2 = 'SELECT * FROM organizing_committee';
                        $qr2 = $pdo->query($stat2);
                        foreach ($qr2 as $rr)
                        {
                                echo '<option value="'.$rr['id'].'" >'.$rr['name'].'</option>' ;
                        }
                    }
                    ?>
                </select>

                <script type="text/javascript">
                    $(document).ready(function() {
                        $('.js-example-basic-multiple').select2();
                    });
                </script>
            </div>
        </div>

        <div class="row">
            <input type="submit" class="btn btn-success" value="Wykonaj">
        </div>
    </form>


    <?php
    if ($_SESSION['role'] == 3 || $_SESSION['role'] == 2) {
        //Hmmm...
    } else if ($_SESSION['role'] == 1) {
        header("Location: ../no-permission.php");
        die();
    } else {
        header("Location: ../login.php");
        die();
    }
    ?>
</div>
</body>
</html>


