<?php
namespace FCT\Watten\Src\Score;

/**
 * Class Set
 *
 * @package FCT\Watten\Src\Score
 */
class Set
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $scoreTeamA;

    /**
     * @var int
     */
    private $scoreTeamB;

    /**
     * Set constructor.
     *
     * @param int $id
     * @param int $scoreTeamA
     * @param int $scoreTeamB
     */
    public function __construct(int $id, int $scoreTeamA, int $scoreTeamB)
    {
        $this->id = $id;
        $this->scoreTeamA = $scoreTeamA;
        $this->scoreTeamB = $scoreTeamB;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getScoreTeamA(): int
    {
        return $this->scoreTeamA;
    }

    /**
     * @return int
     */
    public function getScoreTeamB(): int
    {
        return $this->scoreTeamB;
    }
}