<?php
    include 'dbconnection.php';

   $db = new dbconnection();

    include 'query.php';

    $query = new querybuilder();

    include 'modules.php';

    $modules = new modules();
?>
