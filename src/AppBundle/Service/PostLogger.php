<?php

namespace AppBundle\Service;


use Psr\Log\LoggerInterface;

class PostLogger
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function info($data)
    {
        $this->logger->info($data);
    }
}