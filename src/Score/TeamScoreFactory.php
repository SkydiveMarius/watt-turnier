<?php
namespace FCT\Watten\Src\Score;
use FCT\Watten\Src\Team\TeamRepository;

/**
 * Class TeamScoreRepository
 *
 * @package FCT\Watten\Src\Score
 */
class TeamScoreFactory
{
    /**
     * @var TeamRepository
     */
    private $teamRepository;

    /**
     * @var GameScoreRepository
     */
    private $scoreRepository;

    /**
     * TeamScoreFactory constructor.
     *
     * @param TeamRepository      $teamRepository
     * @param GameScoreRepository $scoreRepository
     */
    public function __construct(TeamRepository $teamRepository = null, GameScoreRepository $scoreRepository = null)
    {
        $this->teamRepository = $teamRepository ?: new TeamRepository();
        $this->scoreRepository = $scoreRepository ?: new GameScoreRepository(null, new GameScoreFactory($this->teamRepository));
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        $teams = $this->teamRepository->getAll();
        $teamScores = [];

        foreach ($teams as $team) {
            $games = $this->scoreRepository->getByTeam($team);
            $teamScores[] = new TeamScore($team, $games);
        }

        return $teamScores;
    }
}