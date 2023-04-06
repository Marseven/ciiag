<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BasicController;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaymentController extends BasicController
{
    //
    public function listPayments()
    {
        BasicController::he_can('Payments', 'look');
        $payment_received = Payment::where('status', STATUT_PENDING)->get();
        foreach ($payment_received as $payment) {
            $delais = BasicController::delais_hour($payment->created_at);
            if ($delais >= 1) {
                $payment->status = STATUT_FAILED;
                $payment->save();
            }
        }
        $payments = Payment::all();
        Log::info('Afficher la liste des paiements à ' . Auth::user()->name);
        return view('admin.payments.list', compact('payments'));
    }

    public function ajaxPayments(Request $request)
    {
        BasicController::he_can('Payments', 'look');


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
        $totalRecords = Payment::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Payment::select('count(*) as allcount')->where('bank', 'like', '%' . $searchValue . '%')->orWhere('payments.transaction_id', 'like', '%' . $searchValue . '%')->orWhere('payments.reference', 'like', '%' . $searchValue . '%')->count();

        // Fetch records
        $records = Payment::orderBy($columnName, $columnSortOrder)
            ->where('payments.bank', 'like', '%' . $searchValue . '%')
            ->orWhere('payments.transaction_id', 'like', '%' . $searchValue . '%')
            ->orWhere('payments.reference', 'like', '%' . $searchValue . '%')
            ->select('payments.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach ($records as $record) {

            $record->load(['user', 'refill', 'refill_uba']);

            $id = $record->reference;

            $bank = $record->bank;
            if ($record->refill_id != null) {
                if ($record->bank == 'orabank') {
                    $number_card = $record->refill->number_card;
                } else {
                    $number_card = $record->refill_uba->number_account;
                }
            } elseif ($record->request_id != null) {
                $number_card = 'ACHAT';
            } elseif ($record->trasnfert_id != null) {
                $number_card = 'TRANSFERT';
            } else {
                $number_card = "";
            }

            $amount = $record->amount;
            $id_transaction = $record->transaction_id;
            $operator = $record->operator;

            $status = BasicController::status($record->status);
            $status = "<span class=\"badge badge-" . $status['type'] . "\">" . $status['message'] . "</span>";
            $date_paid = $record->paid_at;

            $actions = '<button style="padding: 10px !important" type="button"
            class="btn btn-primary modal_view_action"
            data-bs-toggle="modal"
            data-id="' . $record->id . '"
            data-bs-target="#cardModalView' . $record->id . '"><i
                class="icon-eye"></i></button> ';

            if ($record->status != 5) {
                $actions .= ' <button style="padding: 10px !important" type="button"
                        class="btn btn-dark modal_edit_action"
                        data-bs-toggle="modal"
                        data-id="' . $record->id . '"
                        data-bs-target="#cardModal' . $record->id . '"><i
                            class="icon-pencil"></i></button>';
            }



            $data_arr[] = array(
                "reference" => $id,
                "bank" => $bank,
                "number_card" => $number_card,
                "amount" => $amount,
                "transaction_id" => $id_transaction,
                "operator" => $operator,
                "paid_at" => $date_paid,
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

    public function getPayment(Request $request)
    {

        $payment = Payment::find($request->id);

        $title = "";
        $body = "";

        if ($request->action == "view") {
            $payment->load(['user']);
            $status = BasicController::status($payment->status);

            if ($payment->refill_id != null) {
                if ($payment->bank == 'orabank') {
                    $payment->load(['refill']);
                    $entity = $payment->refill;
                    $name_card = $entity->name_card;
                    $number_card = $entity->number_card;
                } else {
                    $payment->load(['refill_uba']);
                    $entity = $payment->refill_uba;
                    $name_card =  $entity->name_account;
                    $number_card = $entity->number_account;
                }
            } elseif ($payment->request_id != null) {
                if ($payment->bank == 'orabank') {
                    $payment->load(['request']);
                    $entity = $payment->request;
                    $phone = $entity->phone;
                } elseif ($payment->bank == 'uba') {
                    $payment->load(['request_uba']);
                    $entity = $payment->request_uba;
                    $phone = $entity->phone1;
                } else {
                    $payment->load(['request_eco']);
                    $entity = $payment->request_eco;
                    $phone = $entity->phone;
                }
            }

            $title = "Paiment N° " . $payment->reference;
            $body = '<div class="row">
            <div class="col-12 mb-5">
                <h6 class="text-uppercase fs-5 ls-2">Description </h6>
                <p class="mb-0">' . $payment->description . '</p>
            </div>
            <div class="col-6 mb-5">
                <h6 class="text-uppercase fs-5 ls-2">Banque
                </h6>
                <p class="mb-0 text-uppercase">' . $payment->bank . '</p>
            </div>
            <div class="col-6 mb-5">
                <h6 class="text-uppercase fs-5 ls-2">Transaction ID
                </h6>
                <p class="mb-0">' . $payment->transaction_id . '</p>
            </div>
            <div class="col-6 mb-5">
                <h6 class="text-uppercase fs-5 ls-2">Montant </h6>
                <p class="mb-0">' . $payment->amount . ' XAF</p>
            </div>
            <div class="col-6 mb-5">
                <h6 class="text-uppercase fs-5 ls-2">Opérateur </h6>
                <p class="mb-0">' . $payment->operator . '</p>
            </div>
            <div class="col-12 mb-5">
                <h6 class="text-uppercase fs-5 ls-2">Date de Paiement</h6>
                <p class="mb-0">' . $payment->paid_at . '</p>
            </div>';

            if ($payment->refill_id != null && $entity != null) {
                $body .= '<div class="col-6 mb-5">
                <h6 class="text-uppercase fs-5 ls-2">Référence</h6>
                <p class="mb-0">' . $entity->reference . '</p>
                </div>
                <div class="col-6 mb-5">
                    <h6 class="text-uppercase fs-5 ls-2">Nom de la Carte</h6>
                    <p class="mb-0">' . $name_card . '</p>
                </div>
                <div class="col-12 mb-5">
                    <h6 class="text-uppercase fs-5 ls-2">N° de la Carte</h6>
                    <p class="mb-0">' . $number_card . '</p>
                </div>';
            } elseif ($payment->request_id != null && $entity != null) {
                $body .= '<div class="col-6 mb-5">
                <h6 class="text-uppercase fs-5 ls-2">Référence</h6>
                <p class="mb-0">' . $entity->r_reference . '</p>
                </div>
                <div class="col-6 mb-5">
                    <h6 class="text-uppercase fs-5 ls-2">Nom de la demande</h6>
                    <p class="mb-0">' . $entity->firstname . ' ' . $entity->lastname . '</p>
                </div>
                <div class="col-12 mb-5">
                    <h6 class="text-uppercase fs-5 ls-2">Téléphone</h6>
                    <p class="mb-0">' . $phone . '</p>
                </div>';
            }

            $body .= '<div class="col-6 mb-5">
                <h6 class="text-uppercase fs-5 ls-2">Statut
                    </h6>
                    <p class="mb-0"><span
                            class="badge badge-' . $status['type'] . '">' . $status['message'] . '</span></p>
                </div>
                <div class="col-6 mb-5">
                    <h6 class="text-uppercase fs-5 ls-2">Utilisateur
                    </h6>
                    <p class="mb-0">' . $payment->user->name . '</p>
                </div>
            </div>';
        } elseif ($request->action == "edit") {

            $body = '<div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabelOne">Mettre à jour le paiement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                </button>
            </div>

            <form action="' .  url('admin/payment/' . $request->id . '') . '" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Opérateur</label>
                        <select id="selectOne" name="operator" class="form-control">
                            <option>airtelmoney</option>
                            <option>moovmoney</option>
                            <option>visa/mastercard</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Transaction ID</label>
                        <input type="text" name="transaction_id" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Montant</label>
                        <input type="number" name="amount" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Date de Paiement</label>
                        <input type="date" name="paid_at" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-success">Enregistrer</button>
                </div>
            </form>';
        }

        $response = array(
            "title" => $title,
            "body" => $body,
        );

        return response()->json($response);
    }

}
