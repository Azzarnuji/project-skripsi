<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailService extends Mailable
{
    use Queueable, SerializesModels;

    public $formData;

    public $emailbody;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($formData)
    {
        $this->formData = $formData;
    }

    public function envelope(){
        return new Envelope(
            subject: 'Kode OTP Lupa Password',
        );
    }

    public function content(){
        return new Content(
            view: 'Authentication.Mail.emailbody',
            with: [
                'email'=>$this->formData['email'],
                'kode_otp'=>$this->formData['kode_otp']
            ]);
    }
    // public function build(){
    //     return $this->subject('Kode OTP Lupa Password')->view('Authentication.Mail.emailbody',[
    //         'email'=>$this->formData['email'],
    //         'kode_otp'=>$this->formData['kode_otp']
    //     ]);
    // }
}
