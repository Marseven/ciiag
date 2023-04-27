
<table>
    <thead>
        <tr>
            <th>N°#</th>
            <th>Nom Complet</th>
            <th>Genre</th>
            <th>Téléphone</th>
            <th>Email</th>
            <th>Pays d'origine</th>
            <th>Adhérant</th>
            <th>Gala</th>
            <th>Atelier 1</th>
            <th>Atelier 2</th>
            <th>Atelier 3</th>
            <th>Atelier 4</th>
            <th>Statut</th>
            <th>Date de création</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($registrations as $registration)
        @php
            $registration->load(['atelierj1', 'atelierj2', 'atelierj3', 'atelierj4'])
        @endphp
            <tr>
                <td>{{ $registration->id }}</td>
                <td>{{ $registration->fisrtname.' '.$registration->lastname }}</td>
                <td>{{ $registration->sexe }}</td>
                <td>{{ $registration->phone_mobile.' - '.$registration->phone_fixe }}</td>
                <td>{{ $registration->email }}</td>
                <td>{{ $registration->country }}</td>
                <td>{{ $registration->adherant == 1 ?  $registration->number_adherant : 'Externe' }}</td>
                <td>{{ $registration->gala == 1 ?  'Oui' : 'Non' }}</td>
                <td>{{ $registration->atelierj1->label }}</td>
                <td>{{ $registration->atelierj2->label  }}</td>
                <td>{{ $registration->atelierj3->label  }}</td>
                <td>{{ $registration->atelierj4->label  }}</td>
                @php
                    $status = App\Http\Controllers\BasicController::status($registration->status);
                @endphp
                <td>{{ $status['message'] }}</td>
                <td>{{ $registration->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
