<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BasicController;
use App\Models\Payment;
use App\Models\Registration;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends BasicController
{
    //
    public function dashboard()
    {
        $nb_reg_pay = Registration::where('status', STATUT_PAID)->count();
        $nb_reg = Registration::all()->count();
        $ca = Payment::where('status', STATUT_PAID)->sum('amount');

        return view('admin.dashboard',[
            'nb_reg_pay' => $nb_reg_pay,
            'nb_reg' => $nb_reg,
            'ca' => $ca,
        ]);
    }

    public function index(){
        return view(
            'admin.registration.index'
        );
    }

    public function  ajaxRegistrations(Request $request)
    {
        ## Read value
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = Registration::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Registration::select('count(*) as allcount')->where('lastname', 'like', '%' . $searchValue . '%')->orWhere('registrations.email', 'like', '%' . $searchValue . '%')->orWhere('registrations.phone_fixe', 'like', '%' . $searchValue . '%')->count();

        // Fetch records
        $records = Registration::orderBy($columnName, $columnSortOrder)
            ->where('registrations.lastname', 'like', '%' . $searchValue . '%')
            ->orWhere('registrations.email', 'like', '%' . $searchValue . '%')
            ->orWhere('registrations.phone_fixe', 'like', '%' . $searchValue . '%')
            ->select('registrations.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach ($records as $record) {

            $record->load(['payment']);

            $id = $record->id;

            $name = $record->firstname.' '.$record->lastname;
            $email = $record->email;
            $gender = $record->sexe == "H" ?  'Homme' : 'Femme';
            $phone = $record->phone_fixe.' / '.$record->phone_mobile;
            $country = $record->country;
            $adherant = $record->adherant == 1 ?  'Adhérent N° : ' . $record->number_adherant : 'Externe';
            $gala = $record->gala == 1 ?  'Oui' : 'Non';

            $status = BasicController::status($record->status);
            $status = '<span class="badge badge-pill badge-soft-' . $status['type'] . ' font-size-12">' . $status['message'] . '</span>';



            $actions = '<button style="margin:10px;" class="m-10 text-primary text-xl modal_view_action" data-bs-toggle="modal"
            data-id="' . $record->id . '"
            data-bs-target="#cardModalView' . $record->id . '">
            <i class="lni lni-eye"></i>
          </button>';


            $actions .= '
          <button style="margin:10px;" class="m-10 text-danger text-xl modal_delete_action" data-bs-toggle="modal"
            data-id="' . $record->id . '"
            data-bs-target="#cardModalCenter' . $record->id . '">
            <i class="lni lni-trash-can"></i>
          </button>';


            $data_arr[] = array(
                "id" => $id,
                "name" => $name,
                "email" => $email,
                "phone" => $phone,
                "gender" => $gender,
                "country" => $country,
                "adherant" => $adherant,
                "gala" => $gala,
                "status" => $status,
                "actions" => $actions,
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        );

        Log::info('Afficher la liste de paiements à ' . Auth::user()->name);

        return response()->json($response);
    }

    //
    public function  getRegistration(Request $request)
    {
        $registration = Registration::find($request->id);

        $title = "";
        $body = "";

        if ($request->action == "view") {
            $registration->load(['atelierj1', 'atelierj2', 'atelierj3', 'atelierj4']);
            $status = BasicController::status($registration->status);

           if($registration->sexe == "F") {$gender =  "Femme";}else{ $gender =  "Homme";};
           if($registration->adherant == 1) {$adherant =  $registration->number_adherant;}else {$adherant = "Externe";}
           if($registration->gala == 1){ $gala =  "Oui";}else  {$gala = "Non";}
            //dd($entreprise);

            $title = "Inscription N° " . $registration->id;
            $body = '<div class="row">
                <div class="col-12 mb-5">
                    <h6 class="mb-0">Nom </h6>
                    <p class="mb-0">' . $registration->firstname . ' ' . $registration->lastname . '</p>
                </div>
                <div class="col-6 mb-5">
                    <h6 class="mb-0">Genre
                    </h6>
                    <p class="mb-0">' . $gender  . '</p>
                </div>
                <div class="col-6 mb-5">
                    <h6 class="mb-0">Téléphone Fixe
                    </h6>
                    <p class="mb-0">' . $registration->phone_fixe . '</p>
                </div>
                <div class="col-6 mb-5">
                    <h6 class="mb-0">Téléphone Mobile
                    </h6>
                    <p class="mb-0">' . $registration->phone_mobile . '</p>
                </div>
                <div class="col-6 mb-5">
                    <h6 class="mb-0">Email
                    </h6>
                    <p class="mb-0">' . $registration->email . '</p>
                </div>

                <div class="col-6 mb-5">
                    <h6 class="mb-0">Pays d\'Origine </h6>
                    <p class="mb-0">' . $registration->country . ' XAF</p>
                </div>
                <div class="col-6 mb-5">
                    <h6 class="mb-0">Adhérent
                    </h6>
                    <p class="mb-0">' . $adherant . '</p>
                </div>
                <div class="col-6 mb-5">
                    <h6 class="mb-0">Gala
                    </h6>
                    <p class="mb-0">' . $gala . '</p>
                </div>
                <div class="col-6 mb-5">
                    <h6 class="mb-0">Jour 1
                    </h6>
                    <p class="mb-0">' . $registration->atelierj1->label  . '</p>
                    <p class="mb-0">' . $registration->atelierj2->label  . '</p>
                </div>
                <div class="col-6 mb-5">
                    <h6 class="mb-0">Jour 2
                    </h6>
                    <p class="mb-0">' . $registration->atelierj3->label  . '</p>
                    <p class="mb-0">' . $registration->atelierj4->label  . '</p>
                </div>

                <div class="col-6 mb-5">
                    <h6 class="mb-0">Statut</h6>
                    <p class="mb-0"><span class="status-btn ' . $status['type'] . '-btn">' . $status['message'] . '</span></p>
                </div>
                <div class="col-6 mb-5">
                    <h6 class="mb-0">Date de Création</h6>
                    <p class="mb-0">' . $registration->created_at . '</p>
                </div>
            </div>';

        } elseif ($request->action == "edit") {

            $body = '';
        } else {

            $body = '
            <form method="POST" action="' . url('admin/entreprise/' . $request->id . '') . '">
                <input type="hidden" name="_token" value="' . csrf_token() . '">
                <input type="hidden" name="delete" value="true">
                <button style="background-color: #d50100 !important;" class="btn btn-danger" type="submit">Supprimer</button>
            </form>';
        }

        $response = array(
            "title" => $title,
            "body" => $body,
        );

        return response()->json($response);
    }
}
