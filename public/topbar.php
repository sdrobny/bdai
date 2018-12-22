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
                <?php echo($_SESSION['username']) ?> &nbsp; &nbsp;<span class="fa glyphicon glyphicon-user"></span>
            </button>
            <div class="dropdown-menu">
                <a href="logout.php">Wyloguj sie</a>
            </div>
        </div>


    </div>
</div>
