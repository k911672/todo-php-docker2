<?php
mb_language("Japanese");
mb_internal_encoding("UTF-8") ;

class Mail {
  public $to;
  public $subject;
  public $message;
  public $headers;

  public function send() {
    mb_send_mail(
      $this->to,
      $this->subject,
      $this->message,
      $this->headers
    );
  }
}



?>
