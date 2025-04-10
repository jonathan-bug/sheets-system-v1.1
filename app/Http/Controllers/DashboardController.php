<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utility\Loader;
use App\Models\Employee;
use App\Models\Period;
use App\Utility\Consumer2025;

class DashboardController extends Controller
{
    public function page() {
        Loader::load();

        $records = (new Consumer2025())->triggerAction(session('period')->id);
        
        $totalEmployees = Employee::all()->count();
        $totalPeriods = Period::all()->count();
        $totalSalaries = number_format($records->sum('v_employee_total'), 2);

        $totalEmpAFP = number_format($records->sum('v_emp_afp'), 2);
        $totalEmpISSS = number_format($records->sum('v_emp_isss'), 2);
        $totalPatAFP = number_format($records->sum('v_pat_afp'), 2);
        $totalPatISSS = number_format($records->sum('v_pat_isss'), 2);
        
        return view('pages.dashboard.index', [
            'totalEmployees' => $totalEmployees,
            'totalPeriods' => $totalPeriods,
            'totalSalaries' => $totalSalaries,
            'totalEmpAFP' => $totalEmpAFP,
            'totalEmpISSS' => $totalEmpISSS,
            'totalPatAFP' => $totalPatAFP,
            'totalPatISSS' => $totalPatISSS
        ]);
    }
}
