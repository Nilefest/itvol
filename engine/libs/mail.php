<?php
class mailLibrary {
    private $hosting;
    private $port;
    private $login;
    private $password;
    
    private $h2t;
    private $mail_lib;
    
    function __construct($hosting, $port, $login, $password, $sender_name) { 
        
        // Файлы phpmailer
        require_once  ENGINE_DIR."/libs/phpmailer/class.phpmailer.php";
        require_once  ENGINE_DIR."/libs/phpmailer/class.smtp.php";
        require_once  ENGINE_DIR."/libs/phpmailer/extras/class.html2text.php";

		$this->hosting = $hosting;
		$this->port = $port;
		$this->login = $login;
		$this->password = $password;
        
        $this->mail_lib = new PHPMailer;
        
        $this->mail_lib->isSMTP(); 
        $this->mail_lib->Host = $this->hosting;
        $this->mail_lib->SMTPAuth = true; 
        $this->mail_lib->Username = $this->login;// Ваш логин 
        $this->mail_lib->Password = $this->password;    // Ваш пароль
        $this->mail_lib->SMTPSecure = "tls";        //tls
        $this->mail_lib->Port = $this->port;
        $this->mail_lib->isHTML(true);
	}
    
    public function send_smtp($title, $body, $to_name, $to_mail, $unsub_link, $file = array()){
        require_once  ENGINE_DIR."/libs/phpmailer/extras/class.html2text.php";
        
        $this->mail_lib->setFrom($this->login, $this->toCode($name_from)); // Проверка сервера, логина и пароля
        $this->mail_lib->setUnsubscribeLink($unsub_link."?mail=".$to_mail);
        
        $this->h2t = new Html2Text($body);
        $this->mail_lib->AltBody = $this->h2t->get_text();

        $this->mail_lib->addAddress($to_mail, $this->toCode($to_name));

        $this->mail_lib->Subject = $this->toCode($title);
        $this->mail_lib->Body = $body;

        // Files
        if(!empty($file)) $this->mail_lib->addAttachment($file['path'], $file['name']);

        if(!$this->mail_lib->send()) "Message could not be sent"."Mailer Error: ". $this->mail_lib->ErrorInfo;
        else "Message send. OK";
    }
    
    private function toCode($text){
        return "=?UTF-8?Q?".str_replace("+","_",str_replace("%","=",urlencode($body)))."?= ";
    }
}
?>