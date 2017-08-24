<?php
namespace FCT\Watten\Src\Score;

use FCT\Watten\Src\Team\Team;

/**
 * Class TeamScore
 *
 * @package FCT\Watten\Src\Score
 */
class TeamScore
{
    /**
     * @var Team
     */
    private $team;

    /**
     * @var GameScore[]
     */
    private $games;

    /**
     * @var int
     */
    private $positiveSetCount;

    /**
     * @var int
     */
    private $pointDeltaSum;

    /**
     * @var int
     */
    private $rank = 0;

    /**
     * TeamScore constructor.
     *
     * @param Team        $team
     * @param GameScore[] $games
     */
    public function __construct(Team $team, array $games)
    {
        $this->team = $team;
        $this->games = $games;
    }

    /**
     * @return int
     */
    public function getPositiveSetCount(): int
    {
        if ($this->positiveSetCount == null) {
            $this->positiveSetCount = 0;

            foreach ($this->games as $game) {
                $this->positiveSetCount += $game->getPositiveSetCount($this->team);
            }
        }

        return $this->positiveSetCount;
    }

    /**
     * @return int
     */
    public function getPointDeltaSum(): int
    {
        if ($this->pointDeltaSum == null) {
            $this->pointDeltaSum = 0;

            foreach ($this->games as $game) {
                $this->pointDeltaSum += $game->getPointsDelta($this->team);
            }
        }

        return $this->pointDeltaSum;
    }

    /**
     * @param int $roundId
     *
     * @return int
     */
    public function getRoundPointsDelta(int $roundId): int
    {
        if (!$this->roundExists($roundId)) {
            throw new \InvalidArgumentException('Round ' . ($roundId) . ' not found in Team Score');
        }

        return $this->games[$roundId - 1]->getPointsDelta($this->team);
    }

    /**
     * @param int $roundId
     *
     * @return int
     */
    public function getRoundPositiveSetCount(int $roundId): int
    {
        if (!$this->roundExists($roundId)) {
            throw new \InvalidArgumentException('Round ' . ($roundId) . ' not found in Team Score');
        }

        return $this->games[$roundId - 1]->getPositiveSetCount($this->team);
    }

    /**
     * @param int $roundId
     *
     * @return bool
     */
    public function roundExists(int $roundId): bool
    {
        return isset($this->games[$roundId - 1]);
    }

    /**
     * @param int $roundId
     *
     * @return string
     */
    public function getRoundColor(int $roundId): string
    {
        if (!$this->roundExists($roundId)) {
            throw new \InvalidArgumentException('Round ' . ($roundId + 1) . ' not found in Team Score');
        }

        $positiveSetCount = $this->getRoundPositiveSetCount($roundId);
        if ($positiveSetCount == 3) {
            return 'olive';
        } elseif ($positiveSetCount == 2) {
            return 'green';
        } else {
            return 'red';
        }
    }

    /**
     * @return Team
     */
    public function getTeam(): Team
    {
        return $this->team;
    }

    /**
     * @return GameScore[]
     */
    public function getGames(): array
    {
        return $this->games;
    }

    /**
     * @return int
     */
    public function getRank(): int
    {
        return $this->rank;
    }

    /**
     * @param int $rank
     */
    public function setRank(int $rank)
    {
        $this->rank = $rank;
    }
}