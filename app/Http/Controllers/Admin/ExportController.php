<?php

namespace App\Http\Controllers\Admin;

use App\Exports\EntreprisesExport;
use App\Exports\RegistrationsExport;
use App\Http\Controllers\BasicController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;

class ExportController extends BasicController
{

    private $excel;

    public function __construct(Excel $excel)
    {
        $this->excel = $excel;
    }

    //
    public function index(Request $request)
    {


        $day = Carbon::now();

        if ($request->type == 'entreprise') {
            $type = "Entrprise";
            if ($request->extension == 'EXCEL') {
                return $this->excel->download(new EntreprisesExport($request->atelier), $type . '-' .$request->atelier . '-' . $day . '.xlsx');
            } elseif ($request->extension == 'CSV') {
                return $this->excel->download(new EntreprisesExport($request->atelier), $type . '-' .$request->atelier . '-' . $day . '.csv');
            }
        } elseif ($request->type == 'registration') {
            $type = "Particular";
            if ($request->extension == 'EXCEL') {
                return $this->excel->download(new RegistrationsExport($request->atelier), $type . '-' .$request->atelier . '-' . $day . '.xlsx');
            } elseif ($request->extension == 'CSV') {
                return $this->excel->download(new RegistrationsExport($request->atelier), $type . '-' .$request->atelier . '-' . $day . '.csv');
            }
        }
    }

}
