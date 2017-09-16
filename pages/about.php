<?php

/*** View ***/
?>
<p>Welcome to Metal Militia!</p>
<?php
    requirePhp("api", "user");
    requirePhp("class", "user");

    $records = getRecordsAll();
    consoleLog($records);
    // $user = getSession("user");
    // consoleLog($user);
    // consoleLog($user->getAdmin());
?>