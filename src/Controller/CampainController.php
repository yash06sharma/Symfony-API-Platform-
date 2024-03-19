<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Campain;
use App\EventSubscriber\CampainMailSubscriber;
use Psr\Log\LoggerInterface;


class CampainController extends AbstractController
{
    public $log;
    public function __construct(LoggerInterface $logger)
    {
        $this->log = $logger;
    }
    
    /**
     * Responsibe to get data and send mail to the registerd email ID.
     * @param Campain $campain
     */
    public function __invoke(Campain $campain)
    {  
        $this->log->info("Data is working");
        return $campain;
    }
}
