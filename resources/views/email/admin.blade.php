@component('mail::message')
    <h1>Bonjour,</h1>

    Une nouvlle inscription a été faite.

    @component('mail::button', ['url' => config('app.url') . 'admin/list-registrations'])
        Voir les inscriptions
    @endcomponent

    Cordialement,
    LA CONFÉRENCE INTERNATIONALE DE L'AUDIT INTERNE
@endcomponent
