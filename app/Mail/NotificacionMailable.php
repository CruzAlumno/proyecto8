<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificacionMailable extends Mailable {
    use Queueable, SerializesModels;
    public function __construct($subject_mail) {
        $this->subject = $subject_mail;
    }
    public function build() {
        return $this->view('emails.notificacion')->subject($this->subject);
    }
    // Propiedades Encapsuladas:
    public $subject;
}
