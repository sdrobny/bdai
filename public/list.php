<?php
require('connection.php');

session_start();
//Conference entity
$statement = 'SELECT * FROM conference;';
$query = $pdo->query($statement);
$conference = $query->fetchAll();


?>
<html>
<head>
    <?php include('head.html'); ?>
    <style>
        .conference-link {
            display: inline;
            border: none;
            background-color: transparent;
            font-weight: bold;
            color: #170D21;
            text-align: left;
            margin: 0;
            padding: 0 0;
        }
    </style>
</head>
<body>
<h1>Konferencje</h1>
<p>Lista konferencji</p>
<br>
<br>
<br>
<div class="col-md-4"></div>
<div class="col-sm-12 col-md-4">
    <ul class="list-group">
        <?php

        if (count($conference) > 0) {

            foreach ($conference as $c) {
                echo '<li class="list-group-item"><form method="POST" action="conference.php"><input type="hidden" value="' . $c['id'] . '" name="id"><input type="submit" class="conference-link" value="' . $c['tittle'] . '"></form> </li>';
            }

        }
        else echo ('<div class="text-muted">Brak aktualnych konferencji.</div>')

        ?>

    </ul>

</div>
<br>
<br>
</body>
</html>
