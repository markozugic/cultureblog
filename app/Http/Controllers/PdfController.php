<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App;


class PdfController extends Controller
{
    public function generatePdf($id){
        $post = Post::find($id);       
        $pdf = App::make('dompdf.wrapper');

        $pdf->loadView('pdf.report',['post' => $post]);
        return $pdf->stream();
    }
}
