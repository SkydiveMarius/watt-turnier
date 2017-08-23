<?php
namespace FCT\Watten\Src\Controller\UI;

use FCT\Watten\Src\Score\GameScoreRepository;
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
    private $repository;

    /**
     * ScoreController constructor.
     *
     * @param GameScoreRepository $repository
     */
    public function __construct(GameScoreRepository $repository = null)
    {
        $this->repository = $repository ?: new GameScoreRepository();
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function show(Request $request): Response
    {
        return $this->render('scores.twig', [
            'navigationItem' => 'scores',
            'round_id'       => 1,
            'scores'         => $this->repository->getByRound(1)
        ]);
    }
}