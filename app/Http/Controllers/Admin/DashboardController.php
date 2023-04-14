<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BasicController;
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
        return view('admin.dashboard');
    }

    public function index(){
        return view(
            'admin.registration.index'
        );
    }

    public function  ajaxRegistration(Request $request)
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
        $totalRecordswithFilter = Registration::select('count(*) as allcount')->where('name', 'like', '%' . $searchValue . '%')->orWhere('entreprises.email', 'like', '%' . $searchValue . '%')->orWhere('entreprises.phone', 'like', '%' . $searchValue . '%')->count();

        // Fetch records
        $records = Registration::orderBy($columnName, $columnSortOrder)
            ->where('entreprises.name', 'like', '%' . $searchValue . '%')
            ->orWhere('entreprises.email', 'like', '%' . $searchValue . '%')
            ->orWhere('entreprises.phone', 'like', '%' . $searchValue . '%')
            ->select('entreprises.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach ($records as $record) {

            $record->load(['manager']);

            $id = $record->id;

            $name = $record->name;
            $email = $record->email;
            $phone = $record->phone;
            $adress = $record->adress;
            $manager = $record->manager != null ? $record->manager->lastname . ' ' . $record->manager->firstname : 'Personne';

            $status = BasicController::status($record->status);
            $status = '<span class="status-btn ' . $status['type'] . '-btn">' . $status['message'] . '</span>';

            $actions = '<button style="margin:10px;" class="m-10 text-primary text-xl modal_view_action" data-bs-toggle="modal"
            data-id="' . $record->id . '"
            data-bs-target="#cardModalView' . $record->id . '">
            <i class="lni lni-eye"></i>
          </button>';


            $actions .= '<button style="margin:10px;" class="m-10 text-warning text-xl modal_edit_action" data-bs-toggle="modal"
            data-id="' . $record->id . '"
            data-bs-target="#cardModal' . $record->id . '">
            <i class="lni lni-pencil"></i>
          </button>
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
                "adress" => $adress,
                "manager" => $manager,
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
        $entreprise = Registration::find($request->id);

        $title = "";
        $body = "";

        if ($request->action == "view") {
            $entreprise->load(['user', 'manager']);
            $status = BasicController::status($entreprise->status);

            $manager = $entreprise->manager != null ? $entreprise->manager->lastname . ' ' . $entreprise->manager->firstname : 'Personne';

            //dd($entreprise);

            $title = "Entreprise N° " . $entreprise->id;
            $body = '<div class="row">
                <div class="col-12 mb-5">
                    <h6 class="mb-0">Nom </h6>
                    <p class="mb-0">' . $entreprise->name . '</p>
                </div>
                <div class="col-6 mb-5">
                    <h6 class="mb-0">Email
                    </h6>
                    <p class="mb-0">' . $entreprise->email . '</p>
                </div>
                <div class="col-6 mb-5">
                    <h6 class="mb-0">Téléphone
                    </h6>
                    <p class="mb-0">' . $entreprise->phone . '</p>
                </div>
                <div class="col-6 mb-5">
                    <h6 class="mb-0">Adresse </h6>
                    <p class="mb-0">' . $entreprise->adress . ' XAF</p>
                </div>
                <div class="col-6 mb-5">
                    <h6 class="mb-0">Gérant </h6>
                    <p class="mb-0">' . $manager . '</p>
                </div>
                <div class="col-6 mb-5">
                    <h6 class="mb-0">Statut</h6>
                    <p class="mb-0"><span class="status-btn ' . $status['type'] . '-btn">' . $status['message'] . '</span></p>
                </div>
                <div class="col-6 mb-5">
                    <h6 class="mb-0">Date de Création</h6>
                    <p class="mb-0">' . $entreprise->created_at . '</p>
                </div>
                <div class="col-6 mb-5">
                    <h6 class="mb-0">Créateur
                    </h6>
                    <p class="mb-0">' . $entreprise->user->lastname . '</p>
                </div>
            </div>';

            //dd($body);
        } elseif ($request->action == "edit") {

            $entreprise->load(['manager']);
            $manager = $entreprise->manager != null ? $entreprise->manager->lastname . ' ' . $entreprise->manager->firstname : 'Personne';

            $body = '<div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabelOne">Mettre à jour l\'entreprise</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                <i class="lni lni-close"></i>
                </button>
            </div>

            <form action="' .  url('admin/entreprise/' . $request->id . '') . '" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="_token" value="' . csrf_token() . '">

                    <div class="input-style-3">
                                    <input name="name" type="text" placeholder="Nom de l\'entreprise" value="' . $entreprise->name . '" />
                                    <span class="icon"><i class="lni lni-linkedin"></i></span>
                                </div>
                                <!-- end input -->
                                <!-- end input -->
                                <div class="input-style-3">
                                    <input name="email" type="text" placeholder="Email" value="' . $entreprise->email . '"  />
                                    <span class="icon"><i class="lni lni-envelope"></i></span>
                                </div>
                                <!-- end input -->
                                <!-- end input -->
                                <div class="input-style-3">
                                    <input name="phone" type="tel" placeholder="Téléphone" value="' . $entreprise->phone . '" />
                                    <span class="icon"><i class="lni lni-phone"></i></span>
                                </div>
                                <!-- end input -->
                                <!-- end input -->
                                <div class="input-style-3">
                                    <input name="adress" type="text" placeholder="Adresse" value="' . $entreprise->adress . '" />
                                    <span class="icon"><i class="lni lni-map-marker"></i></span>
                                </div>
                                <!-- end input -->

                                <!-- end input -->
                                <div class="select-style-2">
                                    <div class="select-position">
                                        <select name="manager">
                                            <option value="' . $entreprise->manager_id . '">' . $manager . '</option>
                                            ';

            $managers = User::where('security_role_id', '<=', 2)->get();
            foreach ($managers as $manager)
                $body .= '<option value="' . $manager->id . '">
                                                    ' . $manager->lastname . ' ' . $manager->firstname . '</option>';

            $body .= '</select>
                                    </div>
                                </div>
                                <!-- end input -->

                                <div class="select-style-2">
                                    <div class="select-position">
                                        <select name="status">
                                        <option value="' . STATUT_ENABLE . '">Actif</option>
                                         <option value="' . STATUT_DISABLE . '">Inactif</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- end input -->
                </div>
                <div class="modal-footer">
                    <button style="background-color: #2b9753 !important;" type="submit" class="btn btn-success">Enregistrer</button>
                </div>
            </form>';
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
