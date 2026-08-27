<?php
require_once './config/database.php';

function db() : PDO {
    static $db = null;

    if ($db === null) {
        $dsn = "mysql:host=".DBHOST.";dbname=".DBNAME.";charset=utf8";
        $db = new PDO($dsn, DBUSER, DBPASS);

        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }

    return $db;
}