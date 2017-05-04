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
    public $to;

    public function sendMail($activation)
    {
        $base_url='http://' . $_SERVER['HTTP_HOST'] . '/login/';
        $this->body = $this->body . '<a href="'. $base_url.'activation/'.$activation.'">'. $base_url.'activation/'.$activation.'</a>';
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
        $mail->SetFrom($from, 'skyskyshinysky developer');
        $mail->AddReplyTo($from,'skyskyshinysky developer');
        $mail->Subject    = $this->subject;
        $mail->MsgHTML($this->body);
        $address = $this->to;
        $mail->AddAddress($address, $this->to);
        $mail->Send();
    }
}