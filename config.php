<?php

$APP_DOMAIN = 'localhost';
$SQL_PASSPORT_ROOT = 'root';
$SQL_PASSPORT_PASSWORD = 'sa';
$SQL_DB_NAME = 'first';
        
function get_global_config_object()
{
    $config->domain_name = $GLOBALS['APP_DOMAIN'];    
    $config->sql_user = $GLOBALS['SQL_PASSPORT_ROOT'];
    $config->sql_pass = $GLOBALS['SQL_PASSPORT_PASSWORD'];
    $config->db_name = $GLOBALS['SQL_DB_NAME'];

    return $config;
}

?>
