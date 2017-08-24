<?php
namespace FCT\Watten\Src\Controller\UI;

use FCT\Watten\Src\Score\EmptyGameScore;
use FCT\Watten\Src\Score\GameScore;
use FCT\Watten\Src\Score\GameScoreFactory;
use FCT\Watten\Src\Score\GameScoreRepository;
use FCT\Watten\Src\Team\TeamRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ScoreController
 *
 * @package FCT\Watten\Src\Controller\UI
 */
class ScoreController extends UiController
{
    /**
     * @var GameScoreRepository
     */
    private $gameScoreRepository;

    /**
     * @var TeamRepository|null
     */
    private $teamRepository;

    /**
     * ScoreController constructor.
     *
     * @param GameScoreRepository $gameScoreRepository
     * @param TeamRepository|null $teamRepository
     */
    public function __construct(GameScoreRepository $gameScoreRepository = null, TeamRepository $teamRepository = null)
    {
        $this->teamRepository = $teamRepository ?: new TeamRepository();
        $this->gameScoreRepository = $gameScoreRepository ?: new GameScoreRepository(null, new GameScoreFactory($this->teamRepository));
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function show(Request $request): Response
    {
        // ToDo: Fetch round ID from request
        $roundId = 1;

        $scores = $this->gameScoreRepository->getByRound($roundId);
        $scores = $this->fillTableGapes($roundId, $scores);

        return $this->render('scores.twig', [
            'navigationItem' => 'scores',
            'round_id'       => $roundId,
            'scores'         => $scores
        ]);
    }

    /**
     * @param int         $roundId
     * @param GameScore[] $gameScores
     *
     * @return array|GameScore[]
     */
    private function fillTableGapes(int $roundId, array $gameScores): array
    {
        $indexed = [];
        foreach ($gameScores as $gameScore) {
            $indexed[$gameScore->getTable()] = $gameScore;
        }

        $maxTables = $this->teamRepository->getNumberOfTeams();
        if ($maxTables % 2 != 0) {
            $maxTables++;
        }
        $maxTables = $maxTables / 2;

        for ($i = 1; $i <= $maxTables; $i++) {
            if (!isset($indexed[$i])) {
                $indexed[$i] = new EmptyGameScore($roundId, $i);
            }
        }

        ksort($indexed);
        return array_values($indexed);
    }
}