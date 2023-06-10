<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AlertaPrecoMail extends Mailable
{
    use Queueable, SerializesModels;
    public $materia_prima;
    public $preco;

    /**
     * Create a new message instance.
     */
    public function __construct($materia_prima, $preco)
    {
        $this->materia_prima = $materia_prima;
        $this->preco = $preco;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Alerta de preço',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {   

        return new Content(
            view: 'alerta-preco-email',
            with:[
                'materia_prima' => $this->materia_prima,
                'preco'=>$this->preco,
            ], 
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
