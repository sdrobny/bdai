<?php
require('connection.php');

if (!isset($_POST['id'])) header('Location: notfound.php');
$conference_id = $_POST['id'];

//Conference entity
$statement = 'SELECT * FROM conference WHERE id =  ' . $conference_id . ';';
$query = $pdo->query($statement);
$conference = $query->fetchAll();

//Conference address
$statement = 'SELECT * FROM address WHERE id = ' . $conference[0]['address_id'];
$query = $pdo->query($statement);
$address = $query->fetchAll();

//Conference plan
$statement = 'SELECT * FROM conference_plan WHERE conference_id = ' . $conference_id;
$query = $pdo->query($statement);
$plan = $query->fetchAll();

//Conference important dates
$statement = 'SELECT * FROM important_dates WHERE conference_id = ' . $conference_id;
$query = $pdo->query($statement);
$dates = $query->fetchAll();

//Conference important dates
$statement = 'SELECT * FROM important_dates WHERE conference_id = ' . $conference_id;
$query = $pdo->query($statement);
$dates = $query->fetchAll();

//Organising committee
$statement = 'SELECT * FROM conference_organizing_committee AS coc LEFT JOIN organizing_committee AS c ON coc.organizing_committee_id = c.id WHERE coc.conference_id = '.$conference_id;
$query = $pdo->query($statement);
$organisingCommittee = $query->fetchAll();

//Partners
$statement = 'SELECT * FROM conference_partner AS cp LEFT JOIN partner AS c ON cp.partner_id = c.id WHERE cp.conference_id = '.$conference_id;
$query = $pdo->query($statement);
$partner = $query->fetchAll();

//Speakers
$statement = 'SELECT * FROM speaker AS s LEFT JOIN conference_plan AS p ON s.id = p.speaker_id WHERE p.conference_id = '.$conference_id;
$query = $pdo->query($statement);
$speaker = $query->fetchAll();

//Conference start and end dates
$statement = 'SELECT * FROM conference_plan WHERE conference_id = ' . $conference_id . ' ORDER BY start_date ASC';
$query = $pdo->query($statement);
$conferenceStartDate = $query->fetch()['start_date'];

$statement = 'SELECT * FROM conference_plan WHERE conference_id = ' . $conference_id . ' ORDER BY end_date ASC';
$query = $pdo->query($statement);
$conferenceEndDate = $query->fetch()['end_date'];



?>

<html>
<head>

</head>
<body>
Tytuł:<?php echo(' ' . $conference[0]['tittle']); ?><br>

Opis:<?php echo(' ' . $conference[0]['description']); ?><br>

Adres:<?php echo(' ' . $address[0]['street']); echo(' ' . $address[0]['city']); ?><br>

<?php echo $conferenceStartDate . ' - ' . $conferenceEndDate ?>

Wydarzenia (<?php echo(count($plan)); ?>)<br>

Ważne Daty (<?php echo(count($dates)); ?>)<br>

Organizatorzy (<?php echo(count($organisingCommittee)); ?>)<br>

Partnerzy (<?php echo(count($partner)); ?>)<br>

Prelegenci (<?php echo(count($speaker)); ?>)<br>


</body>
</html>
