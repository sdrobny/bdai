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

<html>
    <head>
        <?php include('../head.html'); ?>
    </head>
    <body>
        <header class="">
            <h1>Konferencja</h1>
        </header>
        <hr>

        <?php
        if (isset($_SESSION['error_msg']) && $_SESSION['error_msg'] != null) {
            echo '<div class="alert alert-danger">' . $_SESSION['error_msg'] . '</div>';
            $_SESSION['error_msg'] = null;
        }

        if (isset($_SESSION['success_msg']) && $_SESSION['success_msg'] != null) {
            echo '<div class="alert alert-success">' . $_SESSION['success_msg'] . '</div>';
            $_SESSION['success_msg'] = null;
        }
        ?>

        <nav>
            <a href="/panel.php" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>Powrót</a>
            <a href="new.php" class="btn btn-success"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Dodaj</a>
        </nav>
        <hr>
        <div class="table-responsive">
<?php
if ($_SESSION['role'] > 1)
{

    require ('../connection.php');
    $statement = 'SELECT * FROM conference ';
    $query = $pdo->query($statement);

    if ($query->rowCount() > 0)
    {
        echo '<table class="table table-responsive">
                <thead class="bg-primary">
                    <tr>
                        <th>Tytuł</th>
                        <th>Data rozpoczęcia</th>
                        <th>Data zakończenia</th>
                        <th>Opis</th>
                        <th>Adres</th>
                        <th>Organizatorzy</th>
                        <th>Partnerzy</th>
                        <th colspan="4">Akcje</th>
                    </tr>
                </thead>';

        foreach ($query as $row)
        {
            echo '<tr>';
            echo '<td>'.$row['tittle'].'</td>';

            $stm = 'SELECT * FROM conference_plan WHERE conference_id = '.$row['id'];
            $qu = $pdo->query($stm);
            if ($qu->rowCount() > 0)
            {
                foreach ($qu as $rrow)
                {
                    $arrayOfStartDates[] = $rrow['start_date'];
                    $arrayOfEndDates[] = $rrow['end_date'];
                }

                for ($i = 0; $i < count($arrayOfStartDates); $i++)
                {
                    if ($i == 0)
                    {
                        $min_date = date('Y-m-d H:i:s', strtotime($arrayOfStartDates[$i]));
                    }
                    else if ($i != 0)
                    {
                        $new_date = date('Y-m-d H:i:s', strtotime($arrayOfStartDates[$i]));
                         if ($new_date < $min_date)
                        {
                            $min_date = $new_date;
                        }
                    }
                }

                for ($i = 0; $i < count($arrayOfEndDates); $i++)
                {
                    if ($i == 0)
                    {
                        $max_date = date('Y-m-d H:i:s', strtotime($arrayOfEndDates[$i]));
                    }
                    else if ($i != 0)
                    {
                        $new_date = date('Y-m-d H:i:s', strtotime($arrayOfEndDates[$i]));
                        if ($new_date > $max_date)
                        {
                            $max_date = $new_date;
                        }
                    }
                }
                echo '<td>'.$min_date.'</td>';
                echo '<td>'.$max_date.'</td>';
            }
            else
            {
                echo '<td>Brak wydarzeń</td>';
                echo '<td>Brak wydarzeń</td>';
            }


            if (strlen($row['description']) < 20 ) echo '<td>'.$row['description'].'</td>'; else echo '<td>'.substr($row['description'],0,17).'...</td>';

            $stat = 'SELECT * FROM address WHERE id = '.$row['address_id'];
            $qr = $pdo->query($stat);
            if ($qr->rowCount()>0)
            {
                $rr = $qr->fetch();
                echo '<td>'.$rr['street'].'&nbsp'.$rr['building_number'].'</td>';
            }

            $stat = 'SELECT * FROM conference_organizing_committee WHERE conference_id = '.$row['id'];
            $qr = $pdo->query($stat);
            echo '<td>'.$qr->rowCount().'</td>';

            $stat = 'SELECT * FROM conference_partner WHERE conference_id = '.$row['id'];
            $qr = $pdo->query($stat);
            echo '<td>'.$qr->rowCount().'</td>';

            echo "<td><form action='delete.php' method='POST'><input type='hidden' name='id' value='".$row['id']."'><input type='submit' class='btn btn-danger' value='Usuń'></form></td>";
            echo "<td><form action='edit.php' method='POST'><input type='hidden' name='id' value='".$row['id']."'><input type='submit' class='btn btn-primary' value='Edytuj'></form></td>";
            echo "<td><form action='show.php' method='POST'><input type='hidden' name='id' value='".$row['id']."'><input type='submit' class='btn btn-info' value='Szczegóły'></form></td>";
            echo "<td><form action='../conference.php' method='POST'><input type='hidden' name='id' value='".$row['id']."'><input type='submit' class='btn btn-info' value='Strona konferencji'></form></td>";
            echo '</tr>';
        }

        echo '</table>';
    }
    else
    {
        echo '<p class="text-muted">Brak elementów do wyświetlenia</p>';
    }



}
else
{
    header("Location: ../login.php");
    die();
}
?>
        </div>
    </body>
</html>
