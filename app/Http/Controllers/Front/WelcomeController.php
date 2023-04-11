<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\BasicController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FileController;
use App\Models\Demande;
use App\Models\Entreprise;
use App\Models\Offer;
use App\Models\Payment;
use App\Models\Project;
use App\Models\Registration;
use App\Models\School;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class WelcomeController extends BasicController
{
    //
    public function index()
    {
        return view('front.form');
    }

    public function register(Request $request)
    {
        $registration = new Registration();

        $registration->lastname = $request->lastname;
        $registration->firstname = $request->firstname;
        $registration->sexe = $request->sexe;
        $exist = Registration::where('email',  $request->email)->first();
        if($exist != null){
            return back()->error('Cette email est déjà utilisé.');
        }
        $registration->email = $request->email;

        $registration->phone_fixe = $request->phone_fixe;
        $registration->phone_mobile = $request->phone_mobile;
        $registration->country = $request->country;
        $registration->adherant = $request->adherant;
        $registration->number_adherant = $request->number_adherant;
        $registration->gala = $request->gala;

        $registration->status = STATUT_RECEIVE;

        if ($registration->save()){
            return WelcomeController::ebilling($registration);
        }else{
            return back()->with('error', "Une erreur s'est produite.");
        }
    }

    static function create($data)
    {

        $payment = new Payment();
        $payment = Payment::where('registration_id', $data['registration_id'])->first();
        if ($payment) {
            $payment->reference = $data['reference'];
            return $payment->save();
        } else {
            $payment = new Payment();
            $payment->description = $data['description'];
            $payment->reference = $data['reference'];
            $payment->amount = $data['amount'];
            $payment->status = $data['status'];
            $payment->time_out = $data['time_out'];
            $payment->billing_id = $data['billing_id'];
            $payment->registration_id = $data['registration_id'];
            return $payment->save();
        }

    }

    public function update(Request $request, Payment $payment)
    {
        $payment->status = STATUT_PAID;
        $payment->transaction_id = $request->transaction_id;
        $payment->operator = $request->operator;
        $payment->amount = $request->amount;
        $payment->paid_at = $request->paid_at;
        if ($payment->save()) {

            return back()->with('success', "Le paiement a bien été mis à jour !");
        } else {
            return back()->with('error', "Une erreur s'est produite.");
        }
    }

    static function ebilling(Registration $registration)
    {

        $pay = WelcomeController::check_payment($registration->id);
        $invoice = false;

        if ($pay != null) {
            $invoice = WelcomeController::check_invoice($pay);
        }

        if ($pay != null && $invoice != false) {
            $bill_id = $invoice->billing_id;
            $eb_callbackurl = url('/callback/ebilling/' . $registration->id);
        } else {

            $eb_name = $registration->firsname.' '.$registration->lastname;
            $date_due = new \DateTime("2023-05-20");
            if($registration->created_at <= $date_due && $registration->adherant == 1){
                $eb_amount = 300000;
            }elseif($registration->created_at <= $date_due && $registration->adherant == 0){
                $eb_amount = 430000;
            }elseif($registration->created_at > $date_due && $registration->adherant == 0){
                $eb_amount = 370000;
            }else{
                $eb_amount = 500000;
            }
            $eb_shortdescription = "Paiement de l'inscription Pour l'IIAG ";
            $eb_reference = WelcomeController::str_reference(10);
            $eb_email = $registration->email;
            $eb_msisdn = $registration->phone_fixe;
            $eb_callbackurl = url('/callback/ebilling/' . $registration->id);


            $expiry_period = 60; // 60 minutes timeout

            // Creating invoice for a merchant
            $merchant_name = config('app.name');

            $payment = Payment::where('reference', $eb_reference)->first();

            if ($payment) {
                $eb_reference = WelcomeController::str_reference(10);
            }

            // =============================================================
            // ============== E-Billing server invocation ==================
            // =============================================================

            $global_array =
                [
                    'payer_email' => $eb_email,
                    'payer_msisdn' => $eb_msisdn,
                    'amount' => $eb_amount,
                    'short_description' => $eb_shortdescription,
                    'external_reference' => $eb_reference,
                    'payer_name' => $eb_name,
                    'expiry_period' => $expiry_period
                ];

            $content = json_encode($global_array);
            $curl = curl_init(env('SERVER_URL'));
            curl_setopt($curl, CURLOPT_USERPWD, env('USER_NAME') . ":" . env('SHARED_KEY'));
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
            $json_response = curl_exec($curl);

            // Get status code
            $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            // Check status <> 200
            if ($status < 200  || $status > 299) {
                //die("Error: call to URL failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
                return back()->with('error', "Une erreur $status s'est produite lors du paiement, Veuillez réessayer !")->withInput();
            }

            curl_close($curl);

            // Get response in JSON format
            $response = json_decode($json_response, true);

            // Get unique transaction id
            $bill_id = $response['e_bill']['bill_id'];


                $data = [
                    'amount' => $eb_amount,
                    'description' => $eb_shortdescription,
                    'reference' => $eb_reference,
                    'status' => STATUT_PENDING,
                    'time_out' => $expiry_period,
                    'description' => $eb_shortdescription,
                    'billing_id' => $bill_id,
                    'registration_id' => $registration->id,
                ];

                WelcomeController::create($data);
        }

        // Redirect to E-Billing portal
        echo "<form action='" . env('POST_URL') . "' method='post' name='frm'>";
        echo "<input type='hidden' name='invoice_number' value='" . $bill_id . "'>";
        echo "<input type='hidden' name='eb_callbackurl' value='" . $eb_callbackurl . "'>";
        echo "</form>";
        echo "<script language='JavaScript'>";
        echo "document.frm.submit();";
        echo "</script>";

        exit();
    }

    public function callback_ebilling($entity)
    {

        $registration = Registration::find($entity);

        $payment = Payment::where('registration_id', $registration->id)->first();
        if ($payment->status == STATUT_PAID) {
            return view(
                'front.result',
                [
                    'registration' => $registration,
                    'payment' => $payment,
                    'user' => Auth::user(),
                ]
            )->with('succes', 'Votre paiment a bien été reçu. ');
        } else {
            $registration->status = STATUT_FAILED;
            $registration->save();
            return view(
                'front.result',
                [
                    'registration' => $registration,
                    'payment' => $payment,
                    'user' => Auth::user(),
                ]
            )->with('warning', "Votre paiement n'a pas été reçu.");
        }

    }

    public function notify_ebilling()
    {
        if (isset($_POST['reference'])) {
            $payment = Payment::where('reference', $_POST['reference'])->first();
            if ($payment) {
                $payment->status = STATUT_PAID;
                $payment->transaction_id = $_POST['transactionid'];
                $payment->operator = $_POST['paymentsystem'];
                $payment->amount = $_POST['amount'];
                $payment->paid_at = date('Y-m-d H:i');
                if ($payment->save()) {
                    $registration = Registration::find($payment->registration_id);
                    $registration->status = STATUT_PAID;
                    $registration->save();
                    return http_response_code(200);
                } else {
                    return http_response_code(403);
                }
            } else {
                return http_response_code(402);
            }
        } else {
            return http_response_code(401);
        }
    }

    static function str_reference($length)
    {
        $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
        return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
    }

    static function check_invoice(Payment $payment)
    {
        $auth = env('USER_NAME') . ':' . env('SHARED_KEY');
        $base64 = base64_encode($auth);

        $response = Http::withHeaders([
            "Authorization" => "Basic " . $base64
        ])->get(env('SERVER_URL') . $payment->bill_id);

        $response = json_decode($response->body());


        if ($response != null && $response->state == 'ready') {
            return $response;
        } else {
            return false;
        }
    }

    static function check_payment($id)
    {

        $payment = Payment::where('registration_id', $id)->get();

        if ($payment->first() != null) {
            return $payment->first();
        } else {
            return null;
        }
    }


}
