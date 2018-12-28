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
?>

<html>
    <head>
        <?php include('../head.html'); ?>
    </head>
    <body>
        <header class="">
            <h1>Podwydarzenia konferencji</h1>
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
    $statement = 'SELECT * FROM conference_plan ';
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
                        <th>Konferencja</th>
                        <th>Prelegent</th>
                        <th colspan="2">Akcje</th>
                    </tr>
                </thead>';

        foreach ($query as $row)
        {
            echo '<tr>';
            echo '<td>'.$row['tittle'].'</td>';
            echo '<td>'.$row['start_date'].'</td>';
            echo '<td>'.$row['end_date'].'</td>';
            echo '<td>'.$row['description'].'</td>';
            $statement = 'SELECT * FROM conference WHERE id = '.$row['conference_id'];
            $q = $pdo->query($statement);
            $r = $q->fetch();
            echo '<td>'.$r['tittle'].'</td>';
            $statement = 'SELECT * FROM speaker WHERE id = '.$row['speaker_id'];
            $qr = $pdo->query($statement);
            $rr = $qr->fetch();
            echo '<td>'.$rr['name'].'&nbsp'.$rr['surname'].'</td>';



            echo "<td><form action='delete.php' method='POST'><input type='hidden' name='id' value='".$row['id']."'><input type='submit' class='btn btn-danger' value='Usuń'></form></td>";
            echo "<td><form action='edit.php' method='POST'><input type='hidden' name='id' value='".$row['id']."'><input type='submit' class='btn btn-primary' value='Edytuj'></form></td>";
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
