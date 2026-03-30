<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    //
    public function generatePDF()
    {
        $patients=Patient::get();
        $pdf=Pdf::loadView('pdfView',['patients' => $patients]);
        return $pdf->download('patients.pdf');
    }
}
