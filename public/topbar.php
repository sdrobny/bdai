<?php
/**
 * Created by PhpStorm.
 * User: Szymon
 * Date: 11.11.2018
 * Time: 19:29
 */
?>
<div class="col-sm-12 user-bar">
    <div class="col-md-10"></div>
    <div class="col-md-2 text-center">
        <div class="btn-group dropleft">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php if ($_SESSION['username'] != 'guest') echo($_SESSION['username']); else  echo('Gość') ?> &nbsp; &nbsp;<span class="fa glyphicon glyphicon-user"></span>
            </button>
            <div class="dropdown-menu">
                <?php if ($_SESSION['username'] != 'guest') echo '<a href="logout.php">Wyloguj sie</a>' ?>
                <?php if ($_SESSION['username'] != 'guest') echo '<a href="panel.php">Panel administracyjny</a>' ?>
                <?php if ($_SESSION['username'] != 'guest') echo '<a href="list.php">Strona glówna - listing koferencji</a>' ?>
                <?php if ($_SESSION['username'] == 'guest') echo '<a href="login.php">Zaloguj się</a>' ?>
            </div>
        </div>
    </div>
</div>
