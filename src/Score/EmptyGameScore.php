<?php
namespace FCT\Watten\Src\Score;

use FCT\Watten\Src\Team\Team;

/**
 * Class EmptyGameScore
 *
 * @package FCT\Watten\Src\Score
 */
class EmptyGameScore extends GameScore
{
    /**
     * @var bool
     */
    protected $finished = false;

    /**
     * EmptyGameScore constructor.
     *
     * @param int $round
     * @param int $table
     */
    public function __construct(int $round, int $table)
    {
        parent::__construct($round, $table, new Team('', ''), new Team('', ''), []);
    }

    /**
     * @return Team
     */
    public function getTeamA(): Team
    {
        throw new \LogicException('Unable to fetch team of EmptyGameScore');
    }

    /**
     * @return Team
     */
    public function getTeamB(): Team
    {
        throw new \LogicException('Unable to fetch team of EmptyGameScore');
    }
}