<?php
namespace FCT\Watten\Src\Rank;

use FCT\Watten\Src\Score\TeamScore;

/**
 * Class RankList
 *
 * @package FCT\Watten\Src\Rank
 */
class RankList
{
    const PAGE_SIZE = 15;

    /**
     * @var TeamScore[]
     */
    private $teamScores;

    /**
     * @var bool
     */
    private $ordered = false;

    /**
     * RankList constructor.
     *
     * @param TeamScore[] $teamScores
     */
    public function __construct(array $teamScores)
    {
        $this->teamScores = $teamScores;
    }

    /**
     * @return TeamScore[]
     */
    public function getTeamScores(): array
    {
        if (!$this->ordered) {
            $ordered = [];
            foreach ($this->teamScores as $teamScore) {
                $index = ($teamScore->getPositiveSetCount() * 1000000000) + (5000000 + ($teamScore->getPointDeltaSum() * 100) + ($teamScore->getTeam()->getId() - 100));
                $ordered[$index] = $teamScore;
            }
            ksort($ordered);
            $this->teamScores = array_values(array_reverse($ordered));

            foreach ($this->teamScores as $i => $teamScore) {
                $teamScore->setRank($i + 1);
            }
        }

        return $this->teamScores;
    }

    /**
     * @param int $page
     *
     * @return array|TeamScore[]
     */
    public function getPage(int $page): array
    {
        $scores = $this->getTeamScores();
        return array_chunk($scores, self::PAGE_SIZE)[$page - 1];
    }

    /**
     * @return int
     */
    public function getPageCount(): int
    {
        return ceil(count($this->teamScores) / self::PAGE_SIZE);
    }
}