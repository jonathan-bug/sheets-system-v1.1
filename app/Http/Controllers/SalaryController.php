<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Employee;
use App\Models\Salary;

class SalaryController extends Controller
{
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
            'last' => 'required'
        ]);

        if($validated->fails()) {
            $data = [
                'message' => 'Unable to validate',
                'errors' => $validated->errors(),
                'status' => 400
            ];

            return $data;
        }

        $record = Salary::create($request->all());

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
            'last' => 'required'
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
        $salary->last = $request->get('last');
        $salary->save();

        $data = [
            'message' => 'Salary updated successfully',
            'record' => $salary,
            'status' => 200
        ];

        return $data;
    }
}
