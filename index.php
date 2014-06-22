<?php
    include 'loader.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>
    <body>
        <?php                
            $args = array(
              'module_name' => 'bobo',
              'columns' => array(array('name' => 'bobo1', 'type' => 'NVARCHAR(70)'),
                                array('name' => 'bobo2', 'type' => 'NVARCHAR(21000)'),
                                array('name' => 'bobo3', 'type' => 'int')
              )
            );

            $response = $modules->create($args);
        ?>
    </body>
</html>
