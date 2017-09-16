<?php

/*** View ***/
?>
<p>Welcome to Metal Militia!</p>
<?php
    requirePhp("api", "user");
    requirePhp("class", "user");

    $user = getSession("user");
    consoleLog($user);
    consoleLog($user->getAdmin());
?>