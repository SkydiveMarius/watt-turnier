<?php
namespace FCT\Watten\Src\Score;

use FCT\Watten\Src\Team\Team;

/**
 * Class GameScore
 *
 * @package FCT\Watten\Src\Score
 */
class GameScore
{
    /**
     * @var int
     */
    private $round;

    /**
     * @var int
     */
    private $table;

    /**
     * @var Team
     */
    private $teamA;

    /**
     * @var Team
     */
    private $teamB;

    /**
     * @var Set[]
     */
    private $sets;

    /**
     * GameScore constructor.
     *
     * @param int   $round
     * @param int   $table
     * @param Team  $teamA
     * @param Team  $teamB
     * @param Set[] $sets
     */
    public function __construct(int $round, int $table, Team $teamA, Team $teamB, array $sets)
    {
        $this->round = $round;
        $this->table = $table;
        $this->teamA = $teamA;
        $this->teamB = $teamB;
        $this->sets = $sets;
    }

    /**
     * @return int
     */
    public function getRound(): int
    {
        return $this->round;
    }

    /**
     * @return int
     */
    public function getTable(): int
    {
        return $this->table;
    }

    /**
     * @return Team
     */
    public function getTeamA(): Team
    {
        return $this->teamA;
    }

    /**
     * @return Team
     */
    public function getTeamB(): Team
    {
        return $this->teamB;
    }

    /**
     * @return Set[]
     */
    public function getSets(): array
    {
        return $this->sets;
    }
}