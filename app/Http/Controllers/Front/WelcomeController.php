<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\BasicController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FileController;
use App\Mail\DemandeMessage;
use App\Mail\RegistrationMessage;
use App\Models\Demande;
use App\Models\Entreprise;
use App\Models\Membre;
use App\Models\Offer;
use App\Models\Payment;
use App\Models\Project;
use App\Models\Registration;
use App\Models\School;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

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
            return back()->with('error', "Cette email existe déjà.");;
        }
        $registration->email = $request->email;
        $registration->phone_fixe = $request->phone_fixe;
        $registration->phone_mobile = $request->phone_mobile;
        $registration->country = $request->country;
        $registration->adherant = $request->adherant;
        $registration->number_adherant = $request->number_adherant;
        $registration->gala = $request->gala;

        $registration->atelier_j1_a1 = $request->atelier_j1_a1;
        $registration->atelier_j1_a2 = $request->atelier_j1_a2;
        $registration->atelier_j2_a1 = $request->atelier_j2_a1;
        $registration->atelier_j2_a2 = $request->atelier_j2_a2;

        $registration->status = STATUT_RECEIVE;

        if ($registration->save()){
            return WelcomeController::ebilling('reg', $registration);
        }else{
            return back()->with('error', "Une erreur s'est produite.");
        }
    }

    public function entreprise(Request $request)
    {
        $entreprise = new Entreprise();

        $entreprise->label = $request->label;

        $exist = Entreprise::where('email',  $request->email)->first();
        if($exist != null){
            return back()->with('error', "Cette email existe déjà.");;
        }
        $entreprise->email = $request->email;
        $entreprise->phone= $request->phone;
        $entreprise->adress = $request->adress;
        $entreprise->country = $request->country;
        $entreprise->adherant = $request->adherant;
        $entreprise->number_adherant = $request->number_adherant;
        $entreprise->gala = $request->gala;

        $entreprise->atelier_j1_a1 = $request->atelier_j1_a1;
        $entreprise->atelier_j1_a2 = $request->atelier_j1_a2;
        $entreprise->atelier_j2_a1 = $request->atelier_j2_a1;
        $entreprise->atelier_j2_a2 = $request->atelier_j2_a2;

        $entreprise->status = STATUT_RECEIVE;

        //dd($request);

        if ($entreprise->save()){
            $i = 0;
            foreach($request->firstname as $fn){
                $membre = new Membre();
                $membre->firstname = $fn;
                $membre->lastname = $request->lastname[$i];
                $membre->sexe = $request->sexe[$i];
                $membre->entreprise_id = $entreprise->id;
                $membre->status = STATUT_RECEIVE;
                $membre->save();
            }
            return WelcomeController::ebilling('ent', $entreprise);
        }else{
            return back()->with('error', "Une erreur s'est produite.");
        }
    }

    static function create($data)
    {

        $payment = new Payment();
        if(isset($data['registration_id'])){
            $payment = Payment::where('registration_id', $data['registration_id'])->first();
        }else{
            $payment =Payment::where('entreprise_id', $data['entreprise_id'])->first();
        }
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
            if(isset($data['registration_id'])){
                $payment->registration_id = $data['registration_id'];
            }else{
                $payment->entreprise_id = $data['entreprise_id'];
            }
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

    static function ebilling($type, $entity)
    {

        if($type == "reg"){
            $entity = Registration::find($entity)->first();
        }else{
            $entity = Entreprise::find($entity)->first();
        }

        $pay = WelcomeController::check_payment($type, $entity->id);
        $invoice = false;

        if ($pay != null) {
            $invoice = WelcomeController::check_invoice($pay);
        }

        if ($pay != null && $invoice != false) {
            $bill_id = $invoice->billing_id;
            $eb_callbackurl = url('/callback/ebilling/' . $entity->id);
        } else {

            $eb_name = $entity->firsname.' '.$entity->lastname;
            $date_due = new \DateTime("2023-05-20");
            if($entity->created_at <= $date_due && $entity->adherant == 1){
                $eb_amount = 300000;
            }elseif($entity->created_at <= $date_due && $entity->adherant == 0){
                $eb_amount = 430000;
            }elseif($entity->created_at > $date_due && $entity->adherant == 0){
                $eb_amount = 370000;
            }else{
                $eb_amount = 500000;
            }
            if($entity->gala == 1){
                $eb_amount += 100000;
            }

            if($type == 'ent'){
                $eb_amount *= $entity->membres->count();

                if($entity->membres->count() >= 5){
                    $eb_amount *= 0.95;
                }elseif($entity->membres->count() >= 10){
                    $eb_amount *= 0.93;
                }

            }

            if(env('TEST') == true) $eb_amount = 1000;

            $eb_shortdescription = "Paiement de l'inscription Pour l'IIAG ";
            $eb_reference = WelcomeController::str_reference(10);
            $eb_email = $entity->email;
            $eb_msisdn = isset($entity->phone_mobile) ? $entity->phone_mobile : $entity->phone;
            $eb_callbackurl = url('/callback/ebilling/'.$type.'/' . $entity->id);


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

            if($type == "reg"){
                $data = [
                    'amount' => $eb_amount,
                    'description' => $eb_shortdescription,
                    'reference' => $eb_reference,
                    'status' => STATUT_PENDING,
                    'time_out' => $expiry_period,
                    'description' => $eb_shortdescription,
                    'billing_id' => $bill_id,
                    'registration_id' => $entity->id,
                ];
            }else{
                $data = [
                    'amount' => $eb_amount,
                    'description' => $eb_shortdescription,
                    'reference' => $eb_reference,
                    'status' => STATUT_PENDING,
                    'time_out' => $expiry_period,
                    'description' => $eb_shortdescription,
                    'billing_id' => $bill_id,
                    'entreprise_id' => $entity->id,
                ];
            }

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

    public function callback_ebilling($type, $entity)
    {
        if($type == "reg"){
            $registration = Registration::find($entity)->first();
            $payment = Payment::where('registration_id', $registration->id)->first();
        }else{
            $entreprise = Entreprise::find($entity)->first();
            $payment = Payment::where('entreprise_id', $entreprise->id)->first();
        }


        if ($payment->status == STATUT_PAID) {

            if($type == "reg"){
                $entity =  $registration->load(['atelierj1', 'atelierj2', 'atelierj3', 'atelierj4']);
            }else{
               $entity =  $entreprise->load(['membres', 'atelierj1', 'atelierj2', 'atelierj3', 'atelierj4']);
            }


            //dd($registration);

            return view(
                'front.result',
                [
                    'entity' => $entity,
                    'type' => $type,
                    'payment' => $payment,
                    'user' => Auth::user(),
                ]
            )->with('succes', 'Votre paiment a bien été reçu. ');
        } else {
            $registration->status = STATUT_FAILED;
            $registration->save();
            return view(
                'front.form',
            )->with('warning', "Votre paiement n'a pas été reçu.");
        }

    }

    public function notify_ebilling()
    {
        if (isset($_POST['reference'])) {
            $payment = Payment::where('reference', $_POST['reference'])->first();
            if ($payment) {
                $admins = User::where('security_role_id', '<=', 2)->get();
                $payment->status = STATUT_PAID;
                $payment->transaction_id = $_POST['transactionid'];
                $payment->operator = $_POST['paymentsystem'];
                $payment->amount = $_POST['amount'];
                $payment->paid_at = date('Y-m-d H:i');
                if ($payment->save()) {
                    $registration = Registration::find($payment->registration_id);
                    $registration->status = STATUT_PAID;
                    $registration->save();
                    Mail::to($registration->email)->queue(new RegistrationMessage($registration));
                    foreach ($admins as $admin) {
                        Mail::to($admin->email)->queue(new DemandeMessage($registration));
                    }
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

    static function check_payment($type, $id)
    {

        if($type == "reg"){
            $payment = Payment::where('registration_id', $id)->get();
        }else{
            $payment = Payment::where('entreprise_id', $id)->get();
        }

        if ($payment->first() != null) {
            return $payment->first();
        } else {
            return null;
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function lang(Request $request)
    {
        App::setLocale($request->lang);
        session()->put('locale', $request->lang);

        return redirect()->back();
    }


}
