<?php

namespace App\Exports;

use App\Models\Registration;
use App\Models\RequestCard;
use App\Models\RequestCardEcobank;
use App\Models\RequestCardUba;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RegistrationsExport implements FromView
{

    public function __construct($theme)
    {
        $this->theme = $theme;
    }

    public function view(): View
    {
        if($this->theme == 0){
            $registrations = Registration::all();
        }else{
            $registrations = Registration::where('atelier_j1_a1',  $this->theme )
            ->orWhere('atelier_j1_a2',  $this->theme )
            ->orWhere('atelier_j2_a1',  $this->theme )
            ->orWhere('atelier_j2_a2',  $this->theme )->get();
        }

        return view('admin.exports.registration', [
            'registrations' => $registrations,
        ]);
    }
}
