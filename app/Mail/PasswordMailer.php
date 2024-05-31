<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PasswordMailer extends Mailable
{
    use Queueable, SerializesModels;

    public $username;
    public $resetLink;

    public function __construct($username, $resetLink)
    {
        $this->username = $username;
        $this->resetLink = $resetLink;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Project Renegade | Reset your password',
        );
    }

    public function content(): Content
    {
        $image = asset("assets/pictures/rgrp_logo.png");

        return new Content(
            markdown: 'mail.reset_password',
            with: [
                'name' => $this->username, 
                'resetLink' => $this->resetLink, 
                'image' => $image,]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
