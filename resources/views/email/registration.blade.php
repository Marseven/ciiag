@component('mail::message')
    <h1>Bonjour {{$data->firstname.' '.$data->lastname}},</h1>

    Merci pour votre inscription, votre numéro de billet est {{$data->id}}.

    Cordialement,
    LA CONFÉRENCE INTERNATIONALE DE L'AUDIT INTERNE
@endcomponent
