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
    protected $round;

    /**
     * @var int
     */
    protected $table;

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
     * @var bool
     */
    protected $finished = true;

    /**
     * @var int
     */
    private $positiveSetCountA = null;

    /**
     * @var int
     */
    private $positiveSetCountB = null;

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
    public function getPositiveSetCountOfTeamA(): int
    {
        if ($this->positiveSetCountA === null) {
            $this->positiveSetCountA = 0;

            foreach ($this->sets as $set) {
                if ($set->isTeamAWinner()) {
                    $this->positiveSetCountA++;
                }
            }
        }

        return $this->positiveSetCountA;
    }

    /**
     * @return int
     */
    public function getPositiveSetCountOfTeamB(): int
    {
        if ($this->positiveSetCountB === null) {
            $this->positiveSetCountB = 0;

            foreach ($this->sets as $set) {
                if ($set->isTeamBWinner()) {
                    $this->positiveSetCountB++;
                }
            }
        }

        return $this->positiveSetCountB;
    }

    /**
     * @return bool
     */
    public function isTeamAWinner(): bool
    {
        return $this->getPositiveSetCountOfTeamA() > $this->getPositiveSetCountOfTeamB();
    }

    /**
     * @return bool
     */
    public function isTeamBWinner(): bool
    {
        return $this->getPositiveSetCountOfTeamB() > $this->getPositiveSetCountOfTeamA();
    }

    /**
     * @return int
     */
    public function getPointsDeltaOfTeamA(): int
    {
        $delta = 0;

        foreach ($this->sets as $set) {
            $delta += $set->getTeamAScoreDelta();
        }

        return $delta;
    }

    /**
     * @return int
     */
    public function getPointsDeltaOfTeamB(): int
    {
        $delta = 0;

        foreach ($this->sets as $set) {
            $delta += $set->getTeamBScoreDelta();
        }

        return $delta;
    }

    /**
     * @return int
     */
    public function getRound(): int
    {
        return $this->round;
    }

    /**
     * @return string
     */
    public function getTableFormatted(): string
    {
        return str_pad($this->table, 2, '0', STR_PAD_LEFT);
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

    /**
     * @param int $id
     *
     * @return Set
     */
    public function getSet(int $id): Set
    {
        $id--;
        if (!isset($this->sets[$id])) {
            throw new \InvalidArgumentException('Set with ID=' . $id . ' is not defined');
        }

        return $this->sets[$id];
    }

    /**
     * @return bool
     */
    public function isFinished(): bool
    {
        return $this->finished;
    }
}