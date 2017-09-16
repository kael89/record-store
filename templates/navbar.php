<?php
/*** Program ***/
requirePhp("class", "user");
require_once $_SERVER['DOCUMENT_ROOT'] . "/record-store/lib/classes/User.php";

$user = getSession("user");
$admin = getSession("admin");
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
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li id="menu-records" class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Records">Records</a>
                        <ul class="dropdown-menu">
                            <li><a href="records.php?page=browse">Browse by Name</a></li>
                            <li><a href="records.php?page=list">Browse All</a></li>
                            <?php if ($admin) { ?>
                                <li><a href="records.php?page=add">Add Records</a></li>
                            <?php } ?>
                        </ul>
                    </li>
                    <li id="menu-artists" class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Artists">Artists</a>
                        <ul class="dropdown-menu">
                            <li><a href="artists.php?page=browse">Browse by Name</a></li>
                            <li><a href="artists.php?page=list">Browse All</a></li>
                            <?php if ($admin) { ?>
                                <li><a href="artists.php?page=add">Add Artists</a></li>
                            <?php } ?>
                        </ul>
                    </li>
                    <li id="menu-index"><a href="index.php?page=about" title="About">About</a></li>
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
                        <a class="btn btn-default navbar-btn" href="index.php?page=login">Login <span class="glyphicon glyphicon-user"></span></a>
                        <a class="btn btn-primary navbar-btn" href="index.php?page=signup">Signup <span class="glyphicon glyphicon-user"></span></a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </nav>