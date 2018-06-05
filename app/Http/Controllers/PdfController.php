<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App;


class PdfController extends Controller
{
    public function generatePdf($id){
        $client = Client::find($id);       
        $pdf = App::make('dompdf.wrapper');

        $pdf->loadView('pdf.report',['client' => $client]);
        return $pdf->stream();
    }
}
