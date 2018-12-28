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
$statement = 'SELECT * FROM conference_organizing_committee AS coc LEFT JOIN organizing_committee AS c ON coc.organizing_committee_id = c.id WHERE coc.conference_id = ' . $conference_id;
$query = $pdo->query($statement);
$organisingCommittee = $query->fetchAll();

//Partners
$statement = 'SELECT * FROM conference_partner AS cp LEFT JOIN partner AS c ON cp.partner_id = c.id WHERE cp.conference_id = ' . $conference_id;
$query = $pdo->query($statement);
$partner = $query->fetchAll();

//Speakers
//$statement = 'SELECT * FROM speaker AS s LEFT JOIN conference_plan AS p ON s.id = p.speaker_id WHERE p.conference_id = '.$conference_id;
$statement = 'SELECT * FROM speaker;';
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

    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title><?php echo(' ' . $conference[0]['tittle']); ?> - Konferencje.pl</title>
    <link href="conference-theme.css" rel="stylesheet" type="text/css">
    <link href="conference-anim.css" rel="stylesheet" type="text/css">

</head>
<body>

<div class="container">

    <!-- Mobile topbar -->
    <div class="topbar-mobile" id="topbar-mobile">
        <input type="button" value="Otwórz menu" class="mobile-menu-button item-selected" id="mobile-menu-button">
    </div>


    <!-- Mobile menu-->
    <div class="menu-mobile" id="menu-mobile">
        <ul class="menu-vertical" id="mobile-menu">
            <li class="menu-vertical-item item-selected" data-target="conference"><a href="#conference">Konferencja</a>
            </li>
            <li class="menu-vertical-item" data-target="description"><a href="#description">Opis</a></li>
            <li class="menu-vertical-item" data-target="events"><a href="#events">Wydarzenia</a></li>
            <li class="menu-vertical-item" data-target="dates"><a href="#dates">Ważne daty</a></li>
            <li class="menu-vertical-item" data-target="organizers"><a href="#organizers">Organizatorzy & Partnerzy</a>
            </li>
        </ul>
    </div>

    <!--  Dekstop topbar-->
    <div class="topbar-desktop" id="topbar-desktop">

        <div class="topbar-logo">Konferencje.pl</div>
        <ul class="topbar-desktop-menu" id="desktop-menu">
            <li class="topbar-desktop-item item-selected" data-target="conference"><a href="#conference">Konferencja</a>
            </li>
            <li class="topbar-desktop-item" data-target="description"><a href="#description">Opis</a></li>
            <li class="topbar-desktop-item" data-target="events"><a href="#events">Wydarzenia</a></li>
            <li class="topbar-desktop-item" data-target="dates"><a href="#dates">Ważne daty</a></li>
            <li class="topbar-desktop-item" data-target="organizers"><a href="#organizers">Organizatorzy & Partnerzy</a>
            </li>
        </ul>
    </div>

    <section class="conference-main" id="conference">
        <div class="conference-container">
            <div class="conference-name"><?php echo(' ' . $conference[0]['tittle']); ?></div>
            <div class="conference-date"><?php echo substr($conferenceStartDate, 0, 10) ?></div>
            <div class="conference-place"><?php echo($address[0]['street'] . ' ' . $address[0]['building_number'] . ', ' . $address[0]['city']); ?> </div>
        </div>
        <div class="conference-hint">
            <a href="#description">Zobacz więcej</a>
        </div>
    </section>

    <section class="description" id="description">
        <h1 class="section-header-dark">
            O konferencji:
        </h1>

        <div class="section-header-data">
            <span class="distinguish">Kiedy?</span>
            <?php echo $conferenceStartDate . ' - ' . $conferenceEndDate ?>

            <span class="distinguish">Gdzie?</span>
            <?php echo($address[0]['street'] . ' ' . $address[0]['building_number'] . ', ' . $address[0]['city']); ?>

        </div>

        <div class="description-wrapper">
            <p><?php echo(' ' . $conference[0]['description']); ?></p>
        </div>
    </section>

    <?php
    if (count($plan) > 0) {
        echo '<section class="events" id="events">
        <h1 class="section-header-dark">
            Wydarzenia:
        </h1>
        <div class="events-container">';


        foreach ($plan as $event) {


            echo('<div class="event">');
            echo('<div class="event-header">');
            echo('<h1>' . $event['tittle'] . '</h1>');
            echo('<div class="speaker-container">');
            foreach ($speaker as $s) {
                if ($s['id'] == $event['speaker_id']) {
                    echo $s['specialization'] . ' ' . $s['name'] . ' ' . $s ['surname'];
                    echo ' <img src="' . substr($s ['image'], 3) . '" />';
                }
            }
            echo('</div>');
            echo('</div>');
            echo('<div class="section-header-data-left"><span class="distinguish">Start: </span>' . $event['start_date'] . '</div>');
            echo('<div class="section-header-data-left"><span class="distinguish">Koniec: </span>' . $event['end_date'] . '</div>');
            echo('<div class=".description-wrapper border-top">' . $event['description'] . '</div>');
            echo("</div>");

        }

        echo '   </div>
    </section>';
    }
    ?>

    <?php

    if (count($dates) > 0) {

        echo('<section class="dates" id="dates">
        <div class="section-header-dark">Ważne daty</div>
        <ul class="dates-list">');
        foreach ($dates as $date) {
            echo('<li>');
            echo utf8_encode($date['description'] . ' - ' . $date['date']);
            echo('</li>');
        }
        echo('</ul>
        </section>');
    }


    ?>


    <?php
    if (count($organisingCommittee) > 0) {
        echo '<section class="organizers" id="organizers">
        <div>
            <div class="section-header-dark left">Organizatorzy</div>
            <ul class="horizontal-list">';

        foreach ($organisingCommittee as $o) {
            echo('<li>');
            echo '<div><img src="' . substr($o['image'], 3) . '"/></div>';
            echo '<div>' . $o['name'] . ' ' . $o['surname'] . '</div>';
            echo '<div>' . utf8_encode('tel.  ' . $o['phone_number']) . '</div>';
            echo('</li>');
        }

        echo '</ul>
        </div>
    </section>';
    }
    ?>

    <?php
        if ( count($partner) > 0) {
            echo '<section class="partners" id="partners">
        <div>
            <div class="section-header-dark right">Partnerzy</div>
            <ul class="horizontal-list">';

            foreach ($partner as $p) {
                echo('<li>');
                echo '<div><img src="' . substr($p['image'], 3) . '"/></div>';
                echo '<div>' . $p['name'] . '</div>';
                echo '<div><a href="' . utf8_encode('tel.  ' . $p['website']) . '">Strona internetowa</a></div>';
                echo('</li>');
            }

            echo '</ul>
        </div>
    </section>';
        }
    ?>

    <footer>
        Made by Bałek & Drobny. Wszystkie prawa mam to gdzieś.
    </footer>


</div>


</body>
<!--
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
-->
<script src="mojjs.js"></script>
</html>
