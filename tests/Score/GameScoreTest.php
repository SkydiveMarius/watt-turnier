<?php
namespace FCT\Watten\Tests\Score;

use FCT\Watten\Src\Score\GameScore;
use FCT\Watten\Src\Score\Set;
use FCT\Watten\Src\Team\Team;
use PHPUnit\Framework\TestCase;

/**
 * Class GameScoreTest
 *
 * @package FCT\Watten\Tests\Score
 */
class GameScoreTest extends TestCase
{
    /**
     * @var Team
     */
    private $teamA;

    /**
     * @var Team
     */
    private $teamB;

    protected function setUp()
    {
        $this->teamA = new Team('Tom', 'Charly', 100);
        $this->teamB = new Team('Nicky', 'Benny', 101);
    }

    public function test_getPositiveSetCountOfTeamA_correct_2()
    {
        $gameScore = new GameScore(1, 1, $this->teamA, $this->teamB, [
            new Set(1, 12, 9),
            new Set(1, 12, 5),
            new Set(1, 10, 12)
        ]);

        self::assertEquals(2, $gameScore->getPositiveSetCountOfTeamA());
    }

    public function test_getPositiveSetCountOfTeamA_correct_0()
    {
        $gameScore = new GameScore(1, 1, $this->teamA, $this->teamB, [
            new Set(1, 5, 12),
            new Set(1, 3, 12),
            new Set(1, 10, 12)
        ]);

        self::assertEquals(0, $gameScore->getPositiveSetCountOfTeamA());
    }

    public function test_getPositiveSetCountOfTeamB_correct_2()
    {
        $gameScore = new GameScore(1, 1, $this->teamA, $this->teamB, [
            new Set(1, 9, 12),
            new Set(1, 4, 12),
            new Set(1, 12, 10)
        ]);

        self::assertEquals(2, $gameScore->getPositiveSetCountOfTeamB());
    }

    public function test_getPositiveSetCountOfTeamB_correct_0()
    {
        $gameScore = new GameScore(1, 1, $this->teamA, $this->teamB, [
            new Set(1, 12, 4),
            new Set(1, 12, 3),
            new Set(1, 12, 10)
        ]);

        self::assertEquals(0, $gameScore->getPositiveSetCountOfTeamB());
    }

    public function test_getPointsDeltaOfTeamA_correct_positive()
    {
        $gameScore = new GameScore(1, 1, $this->teamA, $this->teamB, [
            new Set(1, 12, 9),
            new Set(1, 12, 5),
            new Set(1, 10, 12)
        ]);

        self::assertEquals(8, $gameScore->getPointsDeltaOfTeamA());
    }

    public function test_getPointsDeltaOfTeamA_correct_negative()
    {
        $gameScore = new GameScore(1, 1, $this->teamA, $this->teamB, [
            new Set(1, 5, 12),
            new Set(1, 3, 12),
            new Set(1, 10, 12)
        ]);

        self::assertEquals(-18, $gameScore->getPointsDeltaOfTeamA());
    }

    public function test_getPointsDeltaOfTeamB_correct_positive()
    {
        $gameScore = new GameScore(1, 1, $this->teamA, $this->teamB, [
            new Set(1, 9, 12),
            new Set(1, 4, 12),
            new Set(1, 12, 10)
        ]);

        self::assertEquals(9, $gameScore->getPointsDeltaOfTeamB());
    }

    public function test_getPointsDeltaOfTeamB_correct_negative()
    {
        $gameScore = new GameScore(1, 1, $this->teamA, $this->teamB, [
            new Set(1, 12, 4),
            new Set(1, 12, 3),
            new Set(1, 12, 10)
        ]);

        self::assertEquals(-19, $gameScore->getPointsDeltaOfTeamB());
    }

    public function test_getTableFormatted_oneDigit()
    {
        $gameScore = new GameScore(1, 1, $this->teamA, $this->teamB, [
            new Set(1, 12, 4),
            new Set(1, 12, 3),
            new Set(1, 12, 10)
        ]);

        self::assertEquals('01', $gameScore->getTableFormatted());
    }

    public function test_getTableFormatted_twoDigit()
    {
        $gameScore = new GameScore(1, 12, $this->teamA, $this->teamB, [
            new Set(1, 12, 4),
            new Set(1, 12, 3),
            new Set(1, 12, 10)
        ]);

        self::assertEquals('12', $gameScore->getTableFormatted());
    }
}