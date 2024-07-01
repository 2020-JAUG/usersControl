<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $name;
    protected $url;
    protected $token;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $url, $token)
    {
        $this->name = $name;
        $this->url = $url;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $url = config('app.url') . route('verify-email', ['token' => $this->token], false);

        return $this->markdown('emails.email_verify', ['user' => $this->name, 'url' => $url, 'token' => $this->token])
            ->subject('Verify your email address')
            ->from(env('MAIL_FROM_ADDRESS'));
    }
}
