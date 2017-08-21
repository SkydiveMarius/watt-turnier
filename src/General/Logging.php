<?php
namespace FCT\Watten\Src\General;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Container\ContainerInterface;

/**
 * Trait Logging
 *
 * @package FCT\Watten\Src\General
 */
trait Logging
{
    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @param ContainerInterface $container
     * @param string             $name
     */
    protected function createLogger(ContainerInterface $container, $name)
    {
        $logDirectory = $container->get('kernel')->getLogDir();

        $this->logger = new Logger($name);
        $this->logger->pushHandler(new StreamHandler($logDirectory . '/' . $name . '.log', Logger::WARNING));
        $this->logger->pushHandler(new StreamHandler($logDirectory . '/' . $name . '.log', Logger::INFO));
    }

    /**
     * @param string $message
     * @param array  $info
     */
    protected function logError($message, array $info)
    {
        if ($this->logger != null) {
            $this->logger->error($message, $info);
        }
    }
}