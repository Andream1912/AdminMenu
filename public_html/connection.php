<?php
//DB CREDENTENSIAL
define('DB_HOST', 'localhost');
define('DB_USER', 'id20289518_unicabio');
define('DB_PASS', 'Ciaociao2023_');
define('DB_NAME', 'id20289518_unica');
try {
    $dbh = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
} catch (PDOException $e) {
    exit("ERROR:" . $e->getMessage());
}
