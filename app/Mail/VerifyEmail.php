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

    public $username;
    public $verificationUrl;

    public function __construct($username, $verificationUrl)
    {
        $this->username = $username;
        $this->verificationUrl = $verificationUrl;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Project Renegade | Verify your account',
        );
    }

    public function content(): Content
    {
        $image = asset("assets/pictures/rgrp_logo.png");

        return new Content(
            markdown: 'mail.verify',
            with: [
                'name' => $this->username, 
                'verificationUrl' => $this->verificationUrl, 
                'image' => $image,]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
