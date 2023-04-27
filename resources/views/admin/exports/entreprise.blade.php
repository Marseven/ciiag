
<table>
    <thead>
        <tr>
            <th>N°#</th>
            <th>Nom de l'entreprise</th>
            <th>Téléphone</th>
            <th>Email</th>
            <th>Adresse</th>
            <th>Pays d'origine</th>
            <th>Adhérant</th>
            <th>Gala</th>
            <th>Nbre de Participants</th>
            <th>Atelier 1</th>
            <th>Atelier 2</th>
            <th>Atelier 3</th>
            <th>Atelier 4</th>
            <th>Statut</th>
            <th>Date de création</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($entreprises as $entreprise)
        @php
            $entreprise->load(['membres', 'atelierj1', 'atelierj2', 'atelierj3', 'atelierj4'])
        @endphp
            <tr>
                <td>{{ $entreprise->id }}</td>
                <td>{{ $entreprise->label }}</td>
                <td>{{ $entreprise->phone }}</td>
                <td>{{ $entreprise->email }}</td>
                <td>{{ $entreprise->adress }}</td>
                <td>{{ $entreprise->country }}</td>
                <td>{{ $entreprise->adherant == 1 ?  $registration->number_adherant : 'Externe' }}</td>
                <td>{{ $entreprise->gala == 1 ?  'Oui' : 'Non' }}</td>
                <td>{{ $entreprise->membres->count() }}</td>
                <td>{{ $entreprise->atelierj1->label }}</td>
                <td>{{ $entreprise->atelierj2->label  }}</td>
                <td>{{ $entreprise->atelierj3->label  }}</td>
                <td>{{ $entreprise->atelierj4->label  }}</td>
                @php
                    $status = App\Http\Controllers\BasicController::status($entreprise->status);
                @endphp
                <td>{{ $status['message'] }}</td>
                <td>{{ $entreprise->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
