<?php

namespace ArtesanIO\ArtesanusBundle\Utils;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;

/**
 * Clase (capa) encargada de abstraer el envío de datos vía email en la aplicación
 */

class Cartero
{
    private $mailer;
    private $container;
    private $contentType;
    private $subject;
    private $from;

    public function __construct(\Swift_Mailer $mailer, Container $container)
    {
        $this->mailer = $mailer;
        $this->contentType = 'text/html';
        $this->subject = $container->getParameter('artesanus.cartero.subject');
        $this->from = array($container->getParameter('artesanus.cartero.from.email') => $container->getParameter('artesanus.cartero.from.host'));
    }

    public function msn($mail, $body, $subject = null)
    {
        $message = \Swift_Message::newInstance()
            ->setContentType($this->contentType)
            ->setSubject((null === $subject) ? $this->subject : $subject)
            ->setFrom($this->from)
            ->setTo($mail)
            ->setBody($body);

        return $this->mailer->send($message);
    }

}


?>
