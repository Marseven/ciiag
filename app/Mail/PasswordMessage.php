<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $data; // Données pour la vue

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from("no-reply@rechargevisa.com", "Recharge Visa") // L'expéditeur
            ->subject('Modification du mot de passe') // Le sujet
            ->markdown('profile.mail-password')
            ->with('data', $this->data);
    }
}
