<?php
namespace FCT\Watten\Src\Controller\UI;

use FCT\Watten\Src\Team\TeamRepository;

/**
 * Class PlayerController
 *
 * @package FCT\Watten\Src\Controller\UI
 */
class PlayerController extends UiController
{
    /**
     * @var TeamRepository
     */
    private $repository;

    /**
     * PlayerController constructor.
     *
     * @param TeamRepository $repository
     */
    public function __construct(TeamRepository $repository = null)
    {
        $this->repository = $repository ?: new TeamRepository();
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show()
    {
        return $this->render('players.twig', [
            'navigationItem' => 'players',
            'teams'          => $this->repository->getAll()
        ]);
    }
}