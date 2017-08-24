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
     * @param GameScore $gameScore
     */
    public function add(GameScore $gameScore)
    {
        $this->connection->createQueryBuilder()
            ->insert('scores')
            ->values([
                'round_id'  => ':round_id',
                'table_id'  => ':table_id',
                'team_a'    => ':team_a',
                'team_b'    => ':team_b',
                'score_a_1' => ':score_a_1',
                'score_a_2' => ':score_a_2',
                'score_a_3' => ':score_a_3',
                'score_b_1' => ':score_b_1',
                'score_b_2' => ':score_b_2',
                'score_b_3' => ':score_b_3',
            ])
            ->setParameters([
                ':round_id'  => $gameScore->getRound(),
                ':table_id'  => $gameScore->getTable(),
                ':team_a'    => $gameScore->getTeamA()->getId(),
                ':team_b'    => $gameScore->getTeamB()->getId(),
                ':score_a_1' => $gameScore->getSet(1)->getScoreTeamA(),
                ':score_b_1' => $gameScore->getSet(1)->getScoreTeamB(),
                ':score_a_2' => $gameScore->getSet(2)->getScoreTeamA(),
                ':score_b_2' => $gameScore->getSet(2)->getScoreTeamB(),
                ':score_a_3' => $gameScore->getSet(3)->getScoreTeamA(),
                ':score_b_3' => $gameScore->getSet(3)->getScoreTeamB()
            ])->execute();
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