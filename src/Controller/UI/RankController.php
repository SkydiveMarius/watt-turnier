<?php
namespace FCT\Watten\Src\Controller\UI;

use FCT\Watten\Src\Rank\RankCalculationService;
use FCT\Watten\Src\Rank\RankList;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class RankController
 *
 * @package FCT\Watten\Src\Controller\UI
 */
class RankController extends UiController
{
    /**
     * @var RankCalculationService
     */
    private $service;

    /**
     * RankController constructor.
     *
     * @param RankCalculationService $service
     */
    public function __construct(RankCalculationService $service = null)
    {
        $this->service = $service ?: new RankCalculationService();
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function show(Request $request): Response
    {
        $page = $this->fetchEntityId($request);
        $rankList = $this->service->calculate();
        $ranks = $rankList->getPage($page);
        $pages = [];

        for ($i = 0; $i < $rankList->getPageCount(); $i++) {
            $pages[] = [
                'id'     => $i + 1,
                'start'  => str_pad($i * RankList::PAGE_SIZE, 2, '0', STR_PAD_LEFT),
                'end'    => str_pad(($i + 1) * RankList::PAGE_SIZE, 2, '0', STR_PAD_LEFT),
                'active' => $page == ($i + 1)
            ];
        }

        return $this->render('rank.twig', [
            'navigationItem' => 'rank',
            'ranks'          => $ranks,
            'pages'          => $pages
        ]);
    }
}