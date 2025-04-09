<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utility\Consumer2025;

class SheetController extends Controller
{
    public function page() {
        return view('pages.sheets.index');
    }

    public function index() {
        $consumer = new Consumer2025();
        return collect($consumer->triggerAction(session('period')->id));
    }
}
