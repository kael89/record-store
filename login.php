<?php
$title = "Login";

require_once "templates/head.php";
require_once "templates/header.php";
?>

<div class="row">
    <div class="col-xs-4">
        <form action="index.php" method="post">
            <fieldset>
                <legend>Login</legend>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Email">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                </div>
                <button type="submit" name="login" class="btn btn-default">Submit</button>
            </fieldset>
        </form>
        <p id="noAccount">Don't have an account yet?</p>
        <a class="btn btn-primary" href="signup.php">Signup!</a>
    </div>
    <div class="col-xs-8"></div>
</div>


<?php require_once "templates/footer.php";