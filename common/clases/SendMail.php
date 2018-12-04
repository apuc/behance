<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 01.10.18
 * Time: 18:18
 */

namespace common\clases;

use common\clases\phpmailer\PHPMailer;
use common\clases\phpmailer\SMTP;
use common\clases\phpmailer\Exception;


class SendMail
{
    protected $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);
        $this->setSMTPConfig([]);
    }

    public function setFrom($from, $name = null)
    {
        $this->mail->setFrom($from, $name);
        return $this;
    }

    public function setSMTPConfig($data)
    {
        $this->mail->isSMTP();
        $this->mail->SMTPAuth = true;
        $this->mail->Port = isset($data['port']) ? $data['port'] : 587;
        $this->mail->Host = isset($data['host']) ? $data['host'] : 'smtp.mail.ru';
        $this->mail->SMTPSecure = isset($data['secure']) ? $data['secure'] : 'tls';
        $this->mail->Username = isset($data['username']) ? $data['username'] : 'and_rei0@mail.ru';
        $this->mail->Password = isset($data['password']) ? $data['password'] : '123edsaqw';
        $this->mail->CharSet = "UTF-8";
        return $this;
    }

    public function addAddress($mail, $name = null)
    {
        $this->mail->addAddress($mail, $name);
        return $this;
    }

    public function setSubject($subject)
    {
        $this->mail->Subject = $subject;
        return $this;
    }

    public function isHTML($flag = true)
    {
        $this->mail->isHTML($flag);
        return $this;
    }

    public function setBody($body)
    {
        $this->mail->Body = $body;
        return $this;
    }

    public function send()
    {
        try {
            return $this->mail->send();
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $this->mail->ErrorInfo;
        }
    }

    public static function create()
    {
        return new SendMail();
    }


}