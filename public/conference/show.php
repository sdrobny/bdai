<?php
/**
 * Created by PhpStorm.
 * User: Ikki
 * Date: 16.12.2018
 * Time: 14:00
 */

session_start();
if (!isset($_SESSION['username'])) $_SESSION['username'] = 'guest';
if (!isset($_SESSION['role'])) $_SESSION['role'] = 1;
if (!isset($_SESSION['logged'])) $_SESSION['logged'] = 0;
?>

<?php

require('../connection.php');
if (isset ($_SESSION['rollPlan']))
    $confId = $_SESSION['rollPlan'];
else
    $confId = $_POST['id'];

$sql = 'SELECT * FROM conference WHERE id = ' . $confId . ';';
$query = $pdo->query($sql);

if ($query->rowCount() == 1) {
    $row = $query->fetch();


    /*
     *
     *

    //wczytywanie wazne daty
    $stat = 'SELECT * FROM important_dates WHERE conference_id = '.$row['id'];
    $qr = $pdo->query($stat);

    if ($qr->rowCount() > 0)
    {
        echo '<br/>Ważne daty:<br/>';

        foreach ($qr as $rrow)
        {
            echo $rrow['description'].'<br/>';
        }
    }



    $stat = 'SELECT * FROM conference_plan WHERE conference_id = '.$row['id'];
    $qr = $pdo->query($stat);

    if ($qr->rowCount() > 0)
    {
        foreach ($qr as $rrow)
        {
            echo $rrow['tittle'].'&nbsp'.date('Y-m-d H:i:s', strtotime($rrow['start_date'])).'&nbsp'.
                date('Y-m-d H:i:s', strtotime($rrow['start_date'])).'&nbsp'.
                "<form action='/conferencePlan/edit.php' method='POST'>
                    <input type='hidden' name='id' value='".$rrow['id']."'>
                    <input type='submit' class='btn btn-info' value='Edytuj'></form>"
                .'&nbsp'.
                "<form action='/conferencePlan/delete.php' method='POST'>
                    <input type='hidden' name='idc' value='".$row['id']."'>
                    <input type='hidden' name='id' value='".$rrow['id']."'>
                    <input type='submit' class='btn btn-info' value='Usuń'></form>";
        }
    }
     * */
}
?>

<html>
<head>
    <?php include('../head.html'); ?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
</head>
<body>
<header class="">
    <h1>Przegląd konferencji</h1>
</header>
</header>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a href="list.php" class="btn btn-primary">Powrót</a>
</nav>

<div class="row">
    <div class="col-md-3"></div>
    <section class="col-md-6">
        <ul class="list-group">
            <li class="list-group-item"><b>Tytuł:</b> <?php echo $row['tittle'] . "<br/>"; ?></li>
            <li class="list-group-item"><b>Opis:</b> <?php echo $row['description'] . "<br/>"; ?></li>
            <li class="list-group-item"><b>Adres:</b>
                <?php $stat = 'SELECT * FROM address WHERE id = ' . $row['address_id'];
                $qr = $pdo->query($stat);
                if ($qr->rowCount() > 0) {
                    $rr = $qr->fetch();
                    echo '<td>' . $rr['street'] . '&nbsp' . $rr['building_number'] . '&nbsp' . $rr['city'] . '</td>';
                } ?>
            </li>
            <li class="list-group-item"><b>Partnerzy:</b>
                <?php $stat = 'SELECT * FROM conference_partner WHERE conference_id = ' . $row['id'];
                $qr = $pdo->query($stat);

                if ($qr->rowCount() > 0) {
                    foreach ($qr as $rrow) {
                        $stat = 'SELECT * FROM partner WHERE id = ' . $rrow['partner_id'] . ';';
                        $q = $pdo->query($stat);
                        $partner = $q->fetch();
                        echo '<div class="pill">' . $partner['name'] . '</div>';
                    }
                } else echo("<i>Brak</i>")
                ?>
            </li>
            <li class="list-group-item"><b>Organizatorzy:</b>
                <?php $stat = 'SELECT * FROM conference_organizing_committee WHERE conference_id = ' . $row['id'];
                $qr = $pdo->query($stat);

                if ($qr->rowCount() > 0) {

                    foreach ($qr as $rrow) {
                        $stat = 'SELECT * FROM organizing_committee WHERE id = ' . $rrow['organizing_committee_id'] . ';';
                        $q = $pdo->query($stat);
                        $organizer = $q->fetch();

                        if ($organizer['surname'] != null) {
                            echo '<div class="pill">' . $organizer['surname'] . '&nbsp' . $organizer['name'] . '</div>';
                        } else
                            echo '<div class="pill">' . $organizer['name'] . '</div>';


                    }


                } else echo '<i>Brak</i>';
                ?>
            </li>

            <li class="list-group-item"><b>Ważne daty:</b>
                <?php

                $stat = 'SELECT * FROM important_dates WHERE conference_id = ' . $row['id'];
                $qr = $pdo->query($stat);

                if ($qr->rowCount() > 0) {

                    foreach ($qr as $rrow) {
                        echo '<div class="pill">' . $rrow['date'] .' - ' . mb_strcut($rrow['description'],0, 10) . '...</div>';
                    }
                } else echo '<i>Brak</i>';
                ?>
            </li>

            <li class="list-group-item"><b>Podwydarzenia:</b>
                <?php
                $stat = 'SELECT * FROM conference_plan WHERE conference_id = '.$row['id'];
                $qr = $pdo->query($stat);

                if ($qr->rowCount() > 0)
                {
                    foreach ($qr as $rrow)
                    {
                        echo '<div class="pill-full">'.$rrow['tittle'].'&nbsp'.date('Y-m-d H:i:s', strtotime($rrow['start_date'])).'&nbsp'.
                            date('Y-m-d H:i:s', strtotime($rrow['start_date'])).'&nbsp'.
                            "<form action='/conferencePlan/edit.php' method='POST'>
                    <input type='hidden' name='id' value='".$rrow['id']."'>
                    <input type='submit' class='btn-small btn-info' value='Edytuj'></form>"
                            .'&nbsp'.
                            "<form action='/conferencePlan/delete.php' method='POST'>
                    <input type='hidden' name='idc' value='".$row['id']."'>
                    <input type='hidden' name='id' value='".$rrow['id']."'>
                    <input type='submit' class='btn-small btn-info' value='Usuń'></form>".'</div>';
                    }
                }
                ?>
            </li>

        </ul>
    </section>
</div>


<?php
if ($_SESSION['role'] == 3 || $_SESSION['role' == 2]) {
    //Hmmm...
} else if ($_SESSION['role'] == 1) {
    header("Location: ../no-permission.php");
    die();
} else {
    header("Location: ../login.php");
    die();
}

if (isset ($_SESSION['rollPlan']))
    unset($_SESSION['rollPlan']);

?>

</body>
</html>