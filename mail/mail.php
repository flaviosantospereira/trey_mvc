<?php

require_once realpath(__DIR__) . "../libs/PHPMailer/PHPMailer.php";
require_once realpath(__DIR__) . "../libs/PHPMailer/POP3.php";
require_once realpath(__DIR__) . "../libs/PHPMailer/SMTP.php";

$mailer = new PHPMailer\PHPMailer();
$pop = new PHPMailer\POP3();
$smtp = new PHPMailer\SMTP();

$mailer->Port = '465';
$mailer->Host = 'smtp.gmail.com';
$mailer->IsHTML(true);
$mailer->STMPSecure = 'ssl';
$mailer->Mailer = 'smtp';
$mailer->CharSet = 'UTF-8';
$mailer->SMTPAuth = true;
$mailer->Username = '';
$mailer->Password = '';
$mailer->SingleTo = true;

$mailer->From = '';
$mailer->FromName = 'Sistema Tray Vendas';
$mailer->addAddress('');
$mailer->Subject = 'Relatório de Vendas Diário';
$mailer->Body = "Relatório de Vendas Diário";

if(!$mailer->send){
    echo $mailer->ErrorInfo;
}