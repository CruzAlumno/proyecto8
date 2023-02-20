<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MessageMailable extends Mailable {
    use Queueable, SerializesModels;
    public function __construct($subject_mail, $content_mail) {
        $this->subject = $subject_mail;
        $this->data = $content_mail;
    }
    public function build() {
        return $this->view('emails.message')->subject($this->subject)->with('contenido', $this->data);
    }
    // Propiedades Encapsuladas:
    public $data, $subject;
}
