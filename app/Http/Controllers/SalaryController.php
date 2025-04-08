<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use App\Models\Employee;
use App\Models\Salary;

class SalaryController extends Controller
{
    public function page($dui) {
        $employee = Employee::find($dui);
        
        return view('pages.salaries.index')->with(['employee' => $employee]);
    }
    
    public function index(string $dui) {
        $employee = Employee::find($dui);
        $salaries = $employee->salaries;

        return $salaries;
    }

    public function destroy($id) {
        $salary = Salary::find($id);

        if(!$salary) {
            $data = [
                'message' => 'Salary not found',
                'status' => 400
            ];

            return $data;
        }

        $salary->delete();

        $data = [
            'message' => 'Salary deleted successfully',
            'status' => 200
        ];

        return $data;
    }

    public function find($id) {
        $salary = Salary::find($id);

        if(!$salary) {
            $data = [
                'message' => 'Salary not found',
                'status' => 400
            ];

            return $data;
        }

        $data = [
            'message' => 'Salary found',
            'record' => $salary,
            'status' => 200
        ];

        return $data;
    }

    public function store(Request $request) {
        $validated = Validator::make($request->all(), [
            'employee_dui' => 'required',
            'amount' => 'required',
        ]);

        if($validated->fails()) {
            $data = [
                'message' => 'Unable to validate',
                'errors' => $validated->errors(),
                'status' => 400
            ];

            return $data;
        }

        $lastDate = Carbon::now()->format('Y-m-d H:i:s');
        
        $record = $request->all();
        $record['last'] = $lastDate;
        $record = Salary::create($record);

        $data = [
            'message' => 'Salary added successfully',
            'record' => $record,
            'status' => 200
        ];

        return $data;
    }

    public function update(Request $request, $id) {
        $validated = Validator::make($request->all(), [
            'employee_dui' => 'required',
            'amount' => 'required',
        ]);

        if($validated->fails()) {
            $data = [
                'message' => 'Unable to validate',
                'status' => 400
            ];

            return $data;
        }
        
        $salary = Salary::find($id);

        if(!$salary) {
            $data = [
                'message' => 'Salary not found',
                'status' => 400
            ];

            return $data;
        }

        $salary->employee_dui = $request->get('employee_dui');
        $salary->amount = $request->get('amount');
        $salary->save();

        $data = [
            'message' => 'Salary updated successfully',
            'record' => $salary,
            'status' => 200
        ];

        return $data;
    }
}
