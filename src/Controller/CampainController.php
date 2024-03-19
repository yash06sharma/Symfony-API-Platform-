<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Campain;
use App\EventSubscriber\CampainMailSubscriber;

class CampainController extends AbstractController
{
    /**
     * $mailer Global mail object variable
     */
    private $mailer;
    /**
     * $em Global Entity Manager Variable
     */
    private $em;
    /**
     * EventDispatcherInterface $eventDispatcher
     */
    private $eventDispatcher;
    /**
     * To initialization
     * @param EntityManagerInterface $entityManager
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(EntityManagerInterface $entityManager, EventDispatcherInterface $eventDispatcher)
    {
        $this->em = $entityManager;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * Responsibe to get data and send mail to the registerd email ID.
     * @param Campain $campain
     */
    public function __invoke(Campain $campain)
    {
        
        return $campain;
        // ->getLastname();
        // $event = new CampainMailSubscriber();
        // $this->eventDispatcher->addSubscriber(new CampainMailSubscriber());
        // $this->eventDispatcher->dispatch($event, CampainMailSubscriber::NAME);
    }
}
