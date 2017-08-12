<?php
require_once "lib/User.php";
require_once "lib/general.php";
$user = getSession("user");
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
                    <li class="active"><a href="index.php">Main Page</a></li>
                    <li><a href="browse-records.php">Browse Records</a></li>
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
                        <a class=" btn btn-default navbar-btn" href="index.php?action=logout">Logout <span class="glyphicon glyphicon-user"></span></a>
                    <?php } else { ?>
                        <a class=" btn btn-default navbar-btn" href="login.php">Login <span class="glyphicon glyphicon-user"></span></a>
                        <a class="btn btn-primary navbar-btn" href="signup.php">Signup <span class="glyphicon glyphicon-user"></span></a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </nav>