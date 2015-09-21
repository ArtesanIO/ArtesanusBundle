<?php

namespace ArtesanIO\ArtesanusBundle\Utils;

/**
 * Clase (capa) encargada de abstraer el envío de datos vía email en la aplicación
 */
class Cartero
{

    private $contentType;
    private $subject = 'ArtesanusBundle | ArtesanIO';
    private $from = array("no-reply@artesan.io" => "artesan.io");
    private $mailer;
    private $to;
    private $body;

    public function __construct(\Swift_Mailer $mailer)
    {
      $this->mailer = $mailer;
      $this->contentType = 'text/html';
      $this->subject = 'SinergiaFC';
      $this->from = array("no-reply@artesan.io" => "artesan.io");
    }

    public function msn($mail, $body, $subject = false)
    {
        $message = \Swift_Message::newInstance()
            ->setContentType($this->contentType)
            ->setSubject($this->subject = $subject)
            ->setFrom($this->from)
            ->setTo($mail)
            ->setBody($body);

        return $this->mailer->send($message);
    }

}


?>
