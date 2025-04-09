<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utility\Consumer2025;
use Barryvdh\DomPDF\Facade\Pdf;

class SheetController extends Controller
{
    public function page() {
        return view('pages.sheets.index');
    }

    public function index() {
        $consumer = new Consumer2025();
        return collect($consumer->triggerAction(session('period')->id));
    }

    public function generate() {
        $consumer = new Consumer2025();
        $sheets = collect($consumer->triggerAction(session('period')->id));

        $pdf = PDF::loadView('pages.sheets.generate', [
            'sheets' => $sheets,
            'today' => today()->format('Y/m/d')
        ]);

        return $pdf->stream();
    }
}
