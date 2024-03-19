<?php
namespace App\EventSubscriber;

use ApiPlatform\Symfony\EventListener\EventPriorities;
use App\Entity\Book;
use App\Entity\Campain;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;

final class CampainMailSubscriber implements EventSubscriberInterface
{

    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['sendMail', EventPriorities::POST_WRITE],
        ];
    }

    public function sendMail(ViewEvent $event): void
    {
        $campain = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();
        
        
        if (!$campain instanceof Campain || Request::METHOD_GET !== $method) {
            return;
        }
        // print_r($campain);die;
        $message = (new Email())
        ->from('tutuapp.center.dmn@gmail.com')
        ->to('06yashsharma@gmail.com')
        ->subject('Trial For Mail')
        ->text(sprintf('The book #%d has been added.',"Yash"));
        
        // $this->mailer->send($message);
    }

}