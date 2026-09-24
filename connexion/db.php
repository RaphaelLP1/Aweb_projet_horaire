<?php declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';

/**
 * Retourne une connexion PDO unique (mise en cache dans une variable statique),
 * pour ne pas rouvrir une connexion à chaque appel de fonction CRUD.
 */
function getDb(): PDO
{
    static $db = null;

    if ($db === null) {
        $db = createConnection(DB_NAME, DB_USER, DB_PASSWORD);
    }

    return $db;
}

function createConnection(string $dbname, string $username, string $passwd): PDO
{
    return new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . $dbname . ";charset=utf8mb4",
        $username,
        $passwd,
        [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4',
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
}
