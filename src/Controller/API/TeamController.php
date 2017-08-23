<?php
namespace FCT\Watten\Src\Controller\API;

use FCT\Watten\Src\Team\TeamFactory;
use FCT\Watten\Src\Team\TeamRepository;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class TeamController
 *
 * @package FCT\Watten\Src\Controller\API
 */
class TeamController extends APIController
{
    /**
     * @var TeamFactory
     */
    private $factory;

    /**
     * @var TeamRepository
     */
    private $repository;

    /**
     * TeamController constructor.
     *
     * @param ContainerInterface|null $container
     * @param TeamFactory             $factory
     * @param TeamRepository          $repository
     */
    public function __construct(ContainerInterface $container = null, TeamFactory $factory = null, TeamRepository $repository = null)
    {
        parent::__construct($container, 'TeamController');
        $this->factory = $factory ?: new TeamFactory();
        $this->repository = $repository ?: new TeamRepository(null, $this->factory);
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function create(Request $request): Response
    {
        return $this->sandbox(function () use($request) {
            $team = $this->factory->createFromRequest($request);
            $this->repository->add($team);
            return new JsonResponse($team, 200);
        });
    }
}