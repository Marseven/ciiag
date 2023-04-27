<?php

namespace App\Exports;

use App\Models\Entreprise;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class EntreprisesExport implements FromView
{
    public function __construct($theme)
    {
        $this->theme = $theme;
    }

    public function view(): View
    {
        if($this->theme == 0){
            $entreprises = Entreprise::all();
        }else{
            $entreprises = Entreprise::where('atelier_j1_a1',  $this->theme )
            ->orWhere('atelier_j1_a2',  $this->theme )
            ->orWhere('atelier_j2_a1',  $this->theme )
            ->orWhere('atelier_j2_a2',  $this->theme )->get();
        }

        return view('admin.exports.entreprise', [
            'entreprises' => $entreprises,
        ]);
    }
}
