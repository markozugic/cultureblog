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
        $pdf->loadHTML('<p>' . $post->body . '</p>');
        return $pdf->stream();
    }
}
