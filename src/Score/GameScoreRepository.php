<?php
namespace FCT\Watten\Src\Score;

use Doctrine\DBAL\Connection;
use FCT\Watten\Src\Persistence\Repository;

/**
 * Class GameScoreRepository
 *
 * @package FCT\Watten\Src\Score
 */
class GameScoreRepository extends Repository
{
    /**
     * @var GameScoreFactory
     */
    private $factory;

    /**
     * GameScoreRepository constructor.
     *
     * @param Connection|null       $connection
     * @param GameScoreFactory|null $factory
     */
    public function __construct(Connection $connection = null, GameScoreFactory $factory = null)
    {
        parent::__construct($connection);
        $this->factory = $factory ?: new GameScoreFactory();
    }

    /**
     * @param int $round
     *
     * @return array
     */
    public function getByRound(int $round)
    {
        $rows = $this->connection->createQueryBuilder()
            ->select('*')
            ->from('scores')
            ->where('round_id = :round_id')
            ->setParameter(':round_id', $round)
            ->orderBy('table_id')
            ->execute()->fetchAll();

        $scores = [];
        foreach ($rows as $row) {
            $scores[] = $this->factory->createFromDatabase($row);
        }

        return $scores;
    }
}