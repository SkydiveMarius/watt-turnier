<?php
namespace FCT\Watten\Src\Persistence;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;

/**
 * Class ConnectionManager
 *
 * @package FCT\Watten\Src\Persistence
 */
final class ConnectionManager
{
    /**
     * @var Connection
     */
    private static $connection;

    private function __construct()
    {
    }

    /**
     * @return Connection
     */
    public static function getConnection(): Connection
    {
        if (self::$connection === null) {
            self::$connection = DriverManager::getConnection([
                'dbname'   => 'watten',
                'user'     => 'watten',
                'password' => 'turnier',
                'driver'   => 'postgres'
            ]);
        }

        return self::$connection;
    }
}