<?php
namespace FCT\Watten\Src\Controller;

use Symfony\Component\HttpFoundation\Request;

/**
 * Class Controller
 *
 * @package FCT\Watten\Src\Controller
 */
abstract class Controller extends \Symfony\Bundle\FrameworkBundle\Controller\Controller
{
    /**
     * @param Request $request
     *
     * @return int
     */
    protected function fetchEntityId(Request $request): int
    {
        $parts = explode('/', $request->getUri());
        return (int) end($parts);
    }
}