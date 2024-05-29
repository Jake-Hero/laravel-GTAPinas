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
            view: 'mail.verify',
            with: [
                'name' => $this->username, 
                'verificationUrl' => $this->verificationUrl, 
                'image' => $image,]
        );
    }

    public function base64EncodeImage($imagePath)
    {
        if (file_exists($imagePath)) {
            $imageData = file_get_contents($imagePath);
            $base64Image = base64_encode($imageData);
            $imageMimeType = mime_content_type($imagePath);
            $base64ImageSrc = 'data:' . $imageMimeType . ';base64,' . $base64Image;
            return $base64ImageSrc;
        } else {
            return ''; // Handle file not found error
        }
    }

    public function attachments(): array
    {
        return [];
    }
}
