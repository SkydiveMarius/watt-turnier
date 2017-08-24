<?php
namespace FCT\Watten\Src\Controller\API;

use FCT\Watten\Src\Score\GameScoreFactory;
use FCT\Watten\Src\Score\GameScoreRepository;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ScoreController
 *
 * @package FCT\Watten\Src\Controller\API
 */
class ScoreController extends APIController
{
    /**
     * @var GameScoreFactory
     */
    private $factory;

    /**
     * @var GameScoreRepository
     */
    private $repository;

    /**
     * ScoreController constructor.
     *
     * @param ContainerInterface|null  $container
     * @param GameScoreRepository|null $factory
     * @param GameScoreRepository|null $repository
     *
     * @internal param string $logName
     */
    public function __construct(ContainerInterface $container = null, GameScoreRepository $factory = null, GameScoreRepository $repository = null)
    {
        parent::__construct($container, 'ScoreController');
        $this->factory = $factory ?: new GameScoreFactory();
        $this->repository = $repository ?: new GameScoreRepository(null, $this->factory);
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function create(Request $request): Response
    {
        return $this->sandbox(function () use ($request) {
            $gameScore = $this->factory->createFromRequest($request);
            $this->repository->add($gameScore);

            return new Response();
        });
    }
}