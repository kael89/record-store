<?php
$title = "Login";

require_once "templates/head.php";
require_once "templates/header.php";
?>

<form id="loginForm" class="form-horizontal" action="index.php?action=login" method="post">
    <fieldset >
        <legend class="col-xs-4"><span>Login</span></legend>
        <div class="col-xs-8"></div>
    </fieldset>
        <div id="email" class="form-group">
            <div class="col-xs-4">
                <input class="form-control" type="email" name="email" class="form-control" placeholder="Email">
            <span class="form-control-feedback"></span>
            </div>
            <label for="email" class="col-xs-8 control-label"></label>
        </div>
        <div id="password" class="form-group">
            <div class="col-xs-4">
                <input class="form-control" type="password" name="password" class="form-control" placeholder="Password">
            <span class="form-control-feedback"></span>
            </div>
            <label for="password" class="col-xs-8 control-label"></label>
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
</form>
<script src="js/login.js"></script>

<p id="noAccount">Don't have an account yet?</p>
<a class="btn btn-primary" href="signup.php">Signup!</a>

<?php require_once "templates/footer.php";