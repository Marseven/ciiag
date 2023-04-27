<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BasicController;
use App\Models\Atelier;
use App\Models\Entreprise;
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
        $nb_reg_pay = Registration::where('status', STATUT_PAID)->count() + Entreprise::where('status', STATUT_PAID)->count();
        $nb_reg = Registration::all()->count();
        $nb_ent = Entreprise::all()->count();
        $ca = Payment::where('status', STATUT_PAID)->sum('amount');

        return view('admin.dashboard',[
            'nb_reg_pay' => $nb_reg_pay,
            'nb_reg' => $nb_reg,
            'nb_ent' => $nb_ent,
            'ca' => $ca,
        ]);
    }

    public function filter(Request $request){
        if($request->send == "view"){
            if($request->type == "entreprise"){

                if($request->atelier == 0){
                    return redirect()->route('admin-list-entreprises', ['atelier' => $request->atelier]);
                }
                return redirect()->route('admin-filter-entreprises', ['atelier' => $request->atelier]);
            }else{
                if($request->atelier == 0){
                    return redirect()->route('admin-list-registrations', ['atelier' => $request->atelier]);
                }
                return redirect()->route('admin-filter-registrations', ['atelier' => $request->atelier]);
            }

        }else{
            return redirect()->route('export', ['type' => $request->type, 'atelier' => $request->atelier, 'extension' => $request->extension]);
        }
        //dd('En cours de réalisation');
    }

    public function index(){
        $ateliers = Atelier::all();
        return view(
            'admin.registration.index', [
                'ateliers' => $ateliers,
            ]
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



            $actions = '<a class="btn btn-outline-primary btn-sm edit modal_view_action" data-bs-toggle="modal"
          data-id="' . $record->id . '"
          data-bs-target="#cardModalView" title="view">
          <i class="fas fa-eye"></i>
      </a>';


            $actions .= '
          <a class="btn btn-outline-danger btn-sm modal_delete_action" data-bs-toggle="modal"
          data-id="' . $record->id . '"
          data-bs-target="#cardModalCenter" title="Delete">
          <i class="fas fa-trash"></i>
      </a>';


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

    public function filterReg(Request $request){
        $ateliers = Atelier::all();
        $at = Atelier::where('id', $request->get('atelier'))->first();

        return view(
            'admin.registration.filter', [
                'ateliers' => $ateliers,
                'at' => $at,
            ]
        );
    }

    public function  ajaxFilterRegistrations(Request $request)
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
        $_GET['search'] = $search_arr['value'];
        $_GET['atelier'] = $request->atelier;
        // Total records
        $totalRecords = Entreprise::select('count(*) as allcount')->where(function ($query) {
            $searchValue =  isset($_GET['atelier']) ? $_GET['atelier'] : '';
            $query->where('atelier_j1_a1',  $searchValue )
                ->orWhere('atelier_j1_a2',  $searchValue )
                ->orWhere('atelier_j2_a1',  $searchValue )
                ->orWhere('atelier_j2_a2',  $searchValue );
        })->count();
        $totalRecordswithFilter = Registration::select('count(*) as allcount')->where(function ($query) {
            $searchValue =  isset($_GET['atelier']) ? $_GET['atelier'] : '';
            $query->where('atelier_j1_a1',  $searchValue )
                ->orWhere('atelier_j1_a2',  $searchValue )
                ->orWhere('atelier_j2_a1',  $searchValue )
                ->orWhere('atelier_j2_a2',  $searchValue );
        })->where('lastname', 'like', '%' . $searchValue . '%')->orWhere('registrations.email', 'like', '%' . $searchValue . '%')->orWhere('registrations.phone_mobile', 'like', '%' . $searchValue . '%')->count();

        // Fetch records
        $records = Registration::orderBy($columnName, $columnSortOrder)
            ->where(function ($query) {
                $searchValue =  isset($_GET['atelier']) ? $_GET['atelier'] : '';
                $query->where('atelier_j1_a1',  $searchValue )
                ->orWhere('atelier_j1_a2',  $searchValue )
                ->orWhere('atelier_j2_a1',  $searchValue )
                ->orWhere('atelier_j2_a2',  $searchValue );
            })
            ->where(function ($query) {
                $searchValue =  isset($_GET['search']) ? $_GET['search'] : '';
                $query->where('registrations.lastname', 'like', '%' . $searchValue . '%')
                      ->orWhere('registrations.email', 'like', '%' . $searchValue . '%')
                      ->orWhere('registrations.phone_mobile', 'like', '%' . $searchValue . '%');
            })
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



            $actions = '<a class="btn btn-outline-primary btn-sm edit modal_view_action" data-bs-toggle="modal"
          data-id="' . $record->id . '"
          data-bs-target="#cardModalView" title="view">
          <i class="fas fa-eye"></i>
      </a>';


            $actions .= '
          <a class="btn btn-outline-danger btn-sm modal_delete_action" data-bs-toggle="modal"
          data-id="' . $record->id . '"
          data-bs-target="#cardModalCenter" title="Delete">
          <i class="fas fa-trash"></i>
      </a>';


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

            $title = "Inscription N° " . $registration->id;
            $body = '<div class="row">
                <div class="col-12 mb-5">
                    <h6 class="mb-0">Nom Complet</h6>
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
                    <h6 class="mb-0">Statut</h6>
                    <p class="mb-0"><span class="badge badge-pill badge-soft-' . $status['type'] . ' font-size-12">'  . $status['message'] . '</span></p>
                </div>

                <div class="col-6 mb-5">
                    <h6 class="mb-0">Jour 1 : 15 juin 2023
                    </h6>
                    <br>
                    <p class="mb-0">' . $registration->atelierj1->label  . '</p>
                    <br>
                    <p class="mb-0">' . $registration->atelierj2->label  . '</p>
                </div>
                <div class="col-6 mb-5">
                    <h6 class="mb-0">Jour 2 : 16 juin 2023
                    </h6>
                    <br>
                    <p class="mb-0">' . $registration->atelierj3->label  . '</p>
                    <br>
                    <p class="mb-0">' . $registration->atelierj4->label  . '</p>
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

    public function entreprises(){
        $ateliers = Atelier::all();
        return view(
            'admin.entreprise.index', [
                'ateliers' => $ateliers,
            ]
        );
    }

    public function  ajaxEntreprises(Request $request)
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
        $totalRecords = Entreprise::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Entreprise::select('count(*) as allcount')->where('label', 'like', '%' . $searchValue . '%')->orWhere('entreprises.email', 'like', '%' . $searchValue . '%')->orWhere('entreprises.phone', 'like', '%' . $searchValue . '%')->count();

        // Fetch records
        $records = Entreprise::orderBy($columnName, $columnSortOrder)
            ->where('entreprises.label', 'like', '%' . $searchValue . '%')
            ->orWhere('entreprises.email', 'like', '%' . $searchValue . '%')
            ->orWhere('entreprises.phone', 'like', '%' . $searchValue . '%')
            ->select('entreprises.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach ($records as $record) {

            $record->load(['payment']);

            $id = $record->id;

            $label = $record->label;
            $adress = $record->adress;
            $email = $record->email;
            $phone = $record->phone;
            $country = $record->country;
            $adherant = $record->adherant == 1 ?  'Adhérent N° : ' . $record->number_adherant : 'Externe';
            $gala = $record->gala == 1 ?  'Oui' : 'Non';

            $status = BasicController::status($record->status);
            $status = '<span class="badge badge-pill badge-soft-' . $status['type'] . ' font-size-12">' . $status['message'] . '</span>';



            $actions = '<a class="btn btn-outline-primary btn-sm edit modal_view_action" data-bs-toggle="modal"
          data-id="' . $record->id . '"
          data-bs-target="#cardModalView" title="view">
          <i class="fas fa-eye"></i>
      </a>';


            $actions .= '
          <a class="btn btn-outline-danger btn-sm modal_view_action" data-bs-toggle="modal"
          data-id="' . $record->id . '"
          data-bs-target="#cardModalCenter" title="Delete">
          <i class="fas fa-trash"></i>
      </a>';


            $data_arr[] = array(
                "id" => $id,
                "label" => $label,
                "email" => $email,
                "phone" => $phone,
                "adress" => $adress,
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

    public function filterEnt(Request $request){
        $ateliers = Atelier::all();
        $at = Atelier::where('id', $request->get('atelier'))->first();
        return view(
            'admin.entreprise.filter', [
                'ateliers' => $ateliers,
                'at' => $at,
            ]
        );
    }

    public function  ajaxFilterEntreprises(Request $request)
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
        $_GET['search'] = $search_arr['value'];
        $_GET['atelier'] = $request->atelier;
        // Total records
        $totalRecords = Entreprise::select('count(*) as allcount')->where(function ($query) {
            $searchValue =  isset($_GET['atelier']) ? $_GET['atelier'] : '';
            $query->where('atelier_j1_a1',  $searchValue )
                ->orWhere('atelier_j1_a2',  $searchValue )
                ->orWhere('atelier_j2_a1',  $searchValue )
                ->orWhere('atelier_j2_a2',  $searchValue );
        })->count();
        $totalRecordswithFilter = Entreprise::select('count(*) as allcount')->where(function ($query) {
            $searchValue =  isset($_GET['atelier']) ? $_GET['atelier'] : '';
            $query->where('atelier_j1_a1',  $searchValue )
                ->orWhere('atelier_j1_a2',  $searchValue )
                ->orWhere('atelier_j2_a1',  $searchValue )
                ->orWhere('atelier_j2_a2',  $searchValue );
        })->where('label', 'like', '%' . $searchValue . '%')->orWhere('entreprises.email', 'like', '%' . $searchValue . '%')->orWhere('entreprises.phone', 'like', '%' . $searchValue . '%')->count();

        // Fetch records
        $records = Entreprise::orderBy($columnName, $columnSortOrder)
            ->where(function ($query) {
                $searchValue =  isset($_GET['atelier']) ? $_GET['atelier'] : '';
                $query->where('atelier_j1_a1',  $searchValue )
                ->orWhere('atelier_j1_a2',  $searchValue )
                ->orWhere('atelier_j2_a1',  $searchValue )
                ->orWhere('atelier_j2_a2',  $searchValue );
            })
            ->where(function ($query) {
                $searchValue =  isset($_GET['search']) ? $_GET['search'] : '';
                $query->where('entreprises.label', 'like', '%' . $searchValue . '%')
                      ->orWhere('entreprises.email', 'like', '%' . $searchValue . '%')
                      ->orWhere('entreprises.phone', 'like', '%' . $searchValue . '%');
            })
            ->select('entreprises.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach ($records as $record) {

            $record->load(['payment']);

            $id = $record->id;

            $label = $record->label;
            $adress = $record->adress;
            $email = $record->email;
            $phone = $record->phone;
            $country = $record->country;
            $adherant = $record->adherant == 1 ?  'Adhérent N° : ' . $record->number_adherant : 'Externe';
            $gala = $record->gala == 1 ?  'Oui' : 'Non';

            $status = BasicController::status($record->status);
            $status = '<span class="badge badge-pill badge-soft-' . $status['type'] . ' font-size-12">' . $status['message'] . '</span>';



            $actions = '<a class="btn btn-outline-primary btn-sm edit modal_view_action" data-bs-toggle="modal"
          data-id="' . $record->id . '"
          data-bs-target="#cardModalView" title="view">
          <i class="fas fa-eye"></i>
      </a>';


            $actions .= '
          <a class="btn btn-outline-danger btn-sm modal_view_action" data-bs-toggle="modal"
          data-id="' . $record->id . '"
          data-bs-target="#cardModalCenter" title="Delete">
          <i class="fas fa-trash"></i>
      </a>';


            $data_arr[] = array(
                "id" => $id,
                "label" => $label,
                "email" => $email,
                "phone" => $phone,
                "adress" => $adress,
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

    public function  getEntreprise(Request $request)
    {
        $entreprise = Entreprise::find($request->id);

        $title = "";
        $body = "";

        if ($request->action == "view") {
            $entreprise->load(['membres', 'atelierj1', 'atelierj2', 'atelierj3', 'atelierj4']);
            $status = BasicController::status($entreprise->status);


           if($entreprise->adherant == 1) {$adherant =  $entreprise->number_adherant;}else {$adherant = "Externe";}
           if($entreprise->gala == 1){ $gala =  "Oui";}else  {$gala = "Non";}
            //dd($entreprise);

            $title = "Inscription N° " . $entreprise->id;
            $body = '<div class="row">
                <div class="col-12 mb-5">
                    <h6 class="mb-0">Nom de l\'entreprise </h6>
                    <p class="mb-0">' . $entreprise->label . '</p>
                </div>

                <div class="col-6 mb-5">
                    <h6 class="mb-0">Téléphone Fixe
                    </h6>
                    <p class="mb-0">' . $entreprise->phone . '</p>
                </div>

                <div class="col-6 mb-5">
                    <h6 class="mb-0">Email
                    </h6>
                    <p class="mb-0">' . $entreprise->email . '</p>
                </div>
                <div class="col-6 mb-5">
                    <h6 class="mb-0">Adresse
                    </h6>
                    <p class="mb-0">' . $entreprise->adress  . '</p>
                </div>
                <div class="col-6 mb-5">
                    <h6 class="mb-0">Pays d\'Origine </h6>
                    <p class="mb-0">' . $entreprise->country . '</p>
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
                    <h6 class="mb-0">Statut</h6>
                    <p class="mb-0"><span class="badge badge-pill badge-soft-' . $status['type'] . ' font-size-12">'  . $status['message'] . '</span></p>
                </div>
                <div class="col-6 mb-5">
                    <h6 class="mb-0">Date de Création</h6>
                    <p class="mb-0">' . $entreprise->created_at . '</p>
                </div>
                <div class="col-6 mb-5">
                    <h6 class="mb-0">Jour 1 : 15 juin 2023
                    </h6>
                    <br>
                    <p class="mb-0">' . $entreprise->atelierj1->label  . '</p>
                    <br>
                    <p class="mb-0">' . $entreprise->atelierj2->label  . '</p>
                </div>
                <div class="col-6 mb-5">
                    <h6 class="mb-0">Jour 2 : 16 juin 2023
                    </h6>
                    <br>
                    <p class="mb-0">' . $entreprise->atelierj3->label  . '</p>
                    <br>
                    <p class="mb-0">' . $entreprise->atelierj4->label  . '</p>
                </div>



                <div class="col-12 mb-5">
                    <h6 class="mb-0">Membres de l\'entrprise
                    </h6>
                    <br>
                    <ol>';
                    foreach($entreprise->membres as $membre){
                        $genre = $membre->sexe == "F" ? 'Mme.': 'M.';
                        $body .= '<li>'.$genre .' '.$membre->firstname.' '.$membre->lastname.'</li>';
                    }

            $body .= '</ol>
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
