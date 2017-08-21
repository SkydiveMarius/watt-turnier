<?php
namespace FCT\Watten\Src\Controller\UI;

/**
 * Class PlayerController
 *
 * @package FCT\Watten\Src\Controller\UI
 */
class PlayerController extends UiController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show()
    {
        return $this->render('players.twig', ['navigationItem' => 'players']);
    }
}