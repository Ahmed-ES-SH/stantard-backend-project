<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $url;


    public function __construct($user)
    {
        $this->user = $user;
        $this->url = url("/api/verify-email/{$user->id}?token=" . urlencode($user->email_verification_token));
    }


    public function build()
    {
        return $this->subject('تفعيل الحساب الخاص بك . ')
            ->view('emails.verify-email')
            ->with([
                'url' => $this->url,
                'user' => $this->user
            ]);
    }
}
