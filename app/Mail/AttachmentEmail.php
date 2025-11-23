<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AttachmentEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $customerName;
    public $serviceName;
    public $providerName;

    public function __construct($customerName, $serviceName, $providerName)
    {
        $this->customerName = $customerName;
        $this->serviceName = $serviceName;
        $this->providerName = $providerName;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Service Request Has Been Approved',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'ADMIN.MAIL',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
