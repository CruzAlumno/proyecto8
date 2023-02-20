<?php

namespace App\Http\Controllers\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Mailable Imports:
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificacionMailable;
use App\Mail\MessageMailable;

class MailController extends Controller {
    public function sendNotification() {
        $direccion = 'devengvengg@gmail.com';
        $mail_subject = "Saludo!";
        $correo = new NotificacionMailable($mail_subject);
        Mail::to($direccion)->send($correo);
        return response()->json(["message" => "Email Sent Successfully."]);
    }
    public function sendNotificationTo($email, $subject) {
        $correo = new NotificacionMailable($subject);
        Mail::to($email)->send($correo);
        return response()->json(["message" => "Email Sent Successfully."]);
    }
    public function sendMailTo($email, $subject, $data) {
        $correo = new MessageMailable($subject, $data);
        Mail::to($email)->send($correo);
        return response()->json(["message" => "Email Sent Successfully."]);
    }
}
