<?php

session_start();
if (!isset($_SESSION['username'])) $_SESSION['username'] = 'guest';
if (!isset($_SESSION['role'])) $_SESSION['role'] = 1;
if (!isset($_SESSION['logged'])) $_SESSION['logged'] = 0;

if ($_SESSION['username'] == 'guest')
{
    header('Location: index.php');
}


?>
<html>
<head>
	<?php include('head.html'); ?>
</head>
<body>
    <h1>Konferencje</h1>
    <p>Panel administracyjny</p>
    <div class="col-sm-12 user-bar">
        <div class="col-md-2">
            Użytkownik: <?php echo($_SESSION['username']) ?><a href="logout.php" class="btn-sm btn-danger">Wyloguj</a>
        </div>
    </div>
    <br>
    <br>
    <br>
    <div class="col-md-4"></div>
    <div class="col-sm-12 col-md-4">
        <ul class="list-group">
            <?php if ($_SESSION['role'] > 2) echo '<li class="list-group-item"><b>Użytkownicy:</b> <a href="user/list.php">Lista</a></li>'  ?>
            <li class="list-group-item"><b>Adresy:</b> <a href="address/list.php">Lista</a></li>
            <li class="list-group-item"><b>Wydarzenia:</b> <a href="conferencePlan/list.php">Lista</a></li>
            <li class="list-group-item"><b>Ważne daty:</b> <a href="importantDates/list.php">Lista</a></li>
            <li class="list-group-item"><b>Komitet organizacyjny:</b> <a href="organizingCommittee/list.php">Lista</a></li>
            <li class="list-group-item"><b>Partnerzy:</b> <a href="partner/list.php">Lista</a></li>
            <li class="list-group-item"><b>Prelegenci:</b> <a href="speaker/list.php">Lista</a></li>
            <li class="list-group-item"><b>Konferencje:</b> <i>W budowie</i></li>
        </ul>
    </div>
    <br>
    <br>
</body>
</html>
