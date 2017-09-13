<?php
/*** Program ***/
requirePhp("class", "user");
require_once $_SERVER['DOCUMENT_ROOT'] . "/record-store/lib/classes/User.php";

$user = getSession("user");
$logoutUri = preg_replace('/\?*?action=[^&]*&?/', '', $_SERVER['REQUEST_URI']);
$logoutUri .= (strpos($logoutUri, '?') === false) ? '?action=logout' : '&action=logout';

/*** View ***/
?>
<div id="container" class="container">
    <div class="row">
        <img class="img-responsive" src="img/logo.png" alt="Metal Militia Logo">
    </div>
    <nav class="row navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Menu</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="nav navbar-nav">
                    <li><a href="?page=main" title="Main Page">Main Page</a></li>
                    <li><a href="?page=records" title="Records">Records</a></li>
                    <li><a href="?page=artists" title="Artists">Artists</a></li>
                </ul>
                <form class="navbar-form navbar-left">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search">
                    </div>
                     <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                </form>
                <div class="navbar-right">
                    <?php if ($user) { ?>
                        <span id="navbarMsg">Welcome, <? echo $user->getFirstName() ?></span>
                        <a class=" btn btn-default navbar-btn" href="<?= $logoutUri ?>">Logout <span class="glyphicon glyphicon-user"></span></a>
                    <?php } else { ?>
                        <a class="btn btn-default navbar-btn" href="?page=login">Login <span class="glyphicon glyphicon-user"></span></a>
                        <a class="btn btn-primary navbar-btn" href="?page=signup">Signup <span class="glyphicon glyphicon-user"></span></a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </nav>