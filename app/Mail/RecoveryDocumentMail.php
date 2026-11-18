<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RecoveryDocumentMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public string $contents) {}

    public function build(): self
    {
        return $this->subject('Archivo de recuperación de cuenta')
            ->text('emails.recovery-document')
            ->attachData($this->contents, 'recuperacion-cuenta.txt', ['mime' => 'text/plain']);
    }
}
