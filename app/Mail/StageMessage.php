<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationPaidMessage extends Mailable
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
        if ($this->data->r_reference) {
            return $this->from("no-reply@digitech-africa.com", "Recharge Visa") // L'expéditeur
                ->subject('Confirmation de commande de Carte N° ' . $this->data->r_reference) // Le sujet
                ->markdown('request_card.mail_notif_paid')
                ->with('data', $this->data);
        } else {
            return $this->from("rechargevisa@digitech-africa.com") // L'expéditeur
                ->subject('Confirmation de commande de Recharge N° ' . $this->data->reference) // Le sujet
                ->markdown('refills.mail_notif_paid')
                ->with('data', $this->data);
        }
    }
}
