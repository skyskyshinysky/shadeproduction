<?php

/**
 * Created by PhpStorm.
 * User: Ilya Pankov
 * Date: 03.05.2017
 * Time: 2:41
 */
class Mail
{
    public $subject="Confirm email";
    public $body='Hello! Confirm your mailbox! Click on the link: ';
    public $base_url='http://www.shadeproduction.local/emailActivation/';
    public function sendMail($to, $activation)
    {
        $this->body = $this->body . '<a href="'. $this->base_url.'activation/'.$activation.'">'. $this->base_url.'activation/'.$activation.'</a>';
        require 'class.phpmailer.php';
        $from       = "from@shadeproduction.local";
        $mail       = new PHPMailer();
        $mail->IsSMTP(true);            // используем протокол SMTP
        $mail->IsHTML(true);
        $mail->SMTPAuth   = true;                  // разрешить SMTP аутентификацию
        $mail->Host       = "tls://smtp.gmail.com"; // SMTP хост
        $mail->Port       =  465;                    // устанавливаем SMTP порт
        $mail->Username   = "skyskyshinysky";  //имя пользователя SMTP
        $mail->Password   = "12qw!@QWCtkmab";  // SMTP пароль
        $mail->SetFrom($from, 'From Name');
        $mail->AddReplyTo($from,'From Name');
        $mail->Subject    = $this->subject;
        $mail->MsgHTML($this->body);
        $address = $to;
        $mail->AddAddress($address, $to);
        $mail->Send();
    }
}