<?php
namespace FCT\Watten\Src\Score;

use FCT\Watten\Src\Team\TeamRepository;

/**
 * Class GameScoreFactory
 *
 * @package FCT\Watten\Src\Score
 */
class GameScoreFactory
{
    /**
     * @var TeamRepository
     */
    private $teamRepository;

    /**
     * GameScoreFactory constructor.
     *
     * @param TeamRepository $teamRepository
     */
    public function __construct(TeamRepository $teamRepository = null)
    {
        $this->teamRepository = $teamRepository ?: new TeamRepository();
    }

    /**
     * @param array $row
     *
     * @return GameScore
     */
    public function createFromDatabase(array $row): GameScore
    {
        $sets = [
            new Set(1, $row['score_a_1'], $row['score_b_1']),
            new Set(2, $row['score_a_2'], $row['score_b_2']),
            new Set(2, $row['score_a_3'], $row['score_b_3'])
        ];

        return new GameScore(
            $row['round_id'],
            $row['table_id'],
            $this->teamRepository->getById($row['team_a']),
            $this->teamRepository->getById($row['team_b']),
            $sets
        );
    }
}