<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * Correo enviado desde el formulario público /contacto (sección "Solicitar
 * información" / "Hablemos de tu proyecto"). El destinatario lo decide el
 * controlador según la empresa elegida en el select; este Mailable solo
 * arma el contenido.
 */
class ContactSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public array $submission)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Nuevo contacto — {$this->submission['company_label']}",
            replyTo: [new Address($this->submission['email'], $this->submission['name'])],
        );
    }

    public function content(): Content
    {
        return new Content(view: 'emails.contact');
    }
}
