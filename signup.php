<?php
$title = "Signup";
require_once "templates/head.php";
require_once "templates/header.php";

$title = 'Signup';
?>

 <form id="signupForm" class="form-horizontal" action="index.php" method="post"> 
    <fieldset>
        <legend class="col-xs-4">Please fill your details bellow:</legend>
        <div class="col-xs-8"></div>
    </fieldset>
    <div id="firstName" class="form-group">
        <div class="col-xs-4">
            <input class="form-control" type="text" name="firstName" placeholder="First name*" maxlength="255">
            <span class="form-control-feedback"></span>
        </div>
        <label for="firstName" class="col-xs-8 control-label"></label>
    </div>
    <div id="lastName" class="form-group">
        <div class="col-xs-4">
            <input class="form-control" type="text" name="lastName" placeholder="Last name*" maxlength="255">
            <span class="form-control-feedback"></span>
        </div>
        <label for="lastName" class="col-xs-8 control-label"></label>
    </div>
    <div id="email" class="form-group">
        <div class="col-xs-4">
            <input class="form-control" type="email" name="email" placeholder="Email*" maxlength="255">
            <span class="form-control-feedback"></span>
        </div>
        <label for="email" class="col-xs-8 control-label"></label>
    </div>
    <div id="password" class="form-group">
        <div class="col-xs-4">
            <input class="form-control" type="password" name="password" placeholder="Password*" minlength="4" maxlength="16">
            <span class="form-control-feedback"></span>
        </div>
        <label for="password" class="col-xs-8 control-label"></label>
    </div>
    <div id="passwordRepeat" class="form-group">
        <div class="col-xs-4">
            <input class="form-control" type="password" name="passwordRepeat" placeholder="Repeat password*" minlength="4" maxlength="16">
            <span class="form-control-feedback"></span>
        </div>
        <label for="passwordRepeat" class="col-xs-8 control-label"></label>
    </div>
    <div id="signup" class="col-xs-12">
        <button class="btn btn-primary" type="submit" name="signup">Signup</button>
    </div>
</form>
<script src="js/signup.js"></script>

<?php require_once "templates/footer.php";
