<?php
namespace FCT\Watten\Src\Persistence;

use Doctrine\DBAL\Connection;

/**
 * Class Repository
 *
 * @package FCT\Watten\Src\Persistence
 */
abstract class Repository
{
    /**
     * @var Connection
     */
    protected $connection;

    /***
     * Repository constructor.
     *
     * @param Connection|null $connection
     */
    public function __construct(Connection $connection = null)
    {
        $this->connection = $connection ?: ConnectionManager::getConnection();
    }
}