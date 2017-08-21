<?php
namespace FCT\Watten\Src\Controller\API;

use FCT\Watten\Src\General\Logging;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class APIController
 *
 * @package FCT\Watten\Src\Controller\API
 */
abstract class APIController extends Controller
{
    use Logging;

    /**
     * APIController constructor.
     *
     * @param ContainerInterface $container
     * @param string             $logName
     */
    public function __construct(ContainerInterface $container = null, $logName)
    {
        if ($container != null) {
            $this->container = $container;
            $this->createLogger($container, $logName);
        }
    }

    /**
     * @param callable $logic
     *
     * @return Response|JsonResponse
     */
    protected function sandbox(callable $logic)
    {
        try {
            return call_user_func($logic);
        } catch (\InvalidArgumentException $e) {
            $this->log($e->getMessage(), ['file' => $e->getFile(), 'line' => $e->getLine()]);
            return new Response($e->getMessage(), 400);
        } catch (\Throwable $e) {
            $this->log($e->getMessage(), ['file' => $e->getFile(), 'line' => $e->getLine()]);
            return new Response('', 500);
        }
    }

    /**
     * @param string $message
     * @param array  $details
     */
    protected function log($message, array $details)
    {
        if ($this->logger != null) {
            $this->logger->error($message, $details);
        }
    }
}