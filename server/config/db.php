<?php

@session_start();
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', 'wfisaias00*');
    define('DB_DATABASE', 'sogreen');
@$db = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
    $db->set_charset("utf8");


?>
