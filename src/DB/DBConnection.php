<?php
namespace Arthur\TaskManager\DB;

use Arthur\TaskManager\Interfaces\DBConnectionInterface;
use PDO;
use Exception;

/**
 * Паттерн Singleton для управления подключением к базе данных.
 * Обеспечивает наличие только одного экземпляра подключения.
 */
final class DBConnection implements DBConnectionInterface
{
    private static ?DBConnection $instance = null;
    private PDO $connection;

    private function __construct()
    {
        $config = include(__DIR__ . '/../../config/config.php');
        $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['dbname'] . ';charset=' . $config['db']['charset'];

        try {
            $this->connection = new PDO($dsn, $config['db']['user'], $config['db']['password']);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            throw new Exception('Ошибка подключения к базе данных: ' . $e->getMessage());
        }
    }

    public static function getInstance(): DBConnection
    {
        if (self::$instance === null) {
            self::$instance = new DBConnection();
        }
        return self::$instance;
    }

    public function connect(): PDO
    {
        return $this->connection;
    }
}
