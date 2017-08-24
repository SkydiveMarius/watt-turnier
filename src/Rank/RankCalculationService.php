<?php
namespace FCT\Watten\Src\Rank;

use FCT\Watten\Src\Score\TeamScoreFactory;

/**
 * Class RankCalculationService
 *
 * @package FCT\Watten\Src\Rank
 */
class RankCalculationService
{
    /**
     * @var TeamScoreFactory
     */
    private $teamScoreFactory;

    /**
     * RankCalculationService constructor.
     *
     * @param TeamScoreFactory $teamScoreFactory
     */
    public function __construct(TeamScoreFactory $teamScoreFactory = null)
    {
        $this->teamScoreFactory = $teamScoreFactory ?: new TeamScoreFactory();
    }

    /**
     * @return RankList
     */
    public function calculate(): RankList
    {
        $teamScores = $this->teamScoreFactory->getAll();
        return new RankList($teamScores);
    }
}