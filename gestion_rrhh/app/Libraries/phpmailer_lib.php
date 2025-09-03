<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    class Phpmailer_lib{
        public function __construct(){
            log_message('Debug', 'PHPMailer class is loaded.');
        }
    
        public function load(){
            require_once APPPATH.'ThirdParty/PHPMailer/Exception.php';
            require_once APPPATH.'ThirdParty/PHPMailer/PHPMailer.php';
            require_once APPPATH.'ThirdParty/PHPMailer/SMTP.php';
  
            $mail=new PHPMailer;
            $mail->IsSMTP(); // telling the class to use SMTP
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = "mailpruebaenvio557@gmail.com";
            $mail->Password = "ioqtowvtcvvpoofm";
            $mail->SMTPSecure = "tls";
            $mail->Port = 587;
            $mail->CharSet = 'UTF-8';
            $mail->setFrom("<Correo quien envia>", "<Nombre personalizado>");
            //$mail->isHTML(true); // Si tu correo contiene codigo HTML
            return $mail;
        }
    }