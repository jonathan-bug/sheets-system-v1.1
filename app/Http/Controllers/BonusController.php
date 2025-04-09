<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Employee;
use App\Models\Bonus;

class BonusController extends Controller
{
    public function page($dui) {
        $employee = Employee::find($dui);

        return view('pages.bonus.index')->with(['employee' => $employee]);
    }
    
    public function index($dui) {
        $employee = Employee::find($dui);
        $bonus = $employee->bonus;

        return $bonus;
    }

    public function destroy($id) {
        $bonus = Bonus::find($id);

        if(!$bonus) {
            $data = [
                'message' => 'Bonus not found',
                'status' => 400
            ];

            return $data;
        }

        $bonus->delete();

        $data = [
            'message' => 'Bonus deleted',
            'status' => 200
        ];

        return $data;
    }

    public function store(Request $request) {
        $validated = Validator::make($request->all(), [
            'employee_dui' => 'required',
            'amount' => 'required'
        ]);

        if($validated->fails()) {
            $data = [
                'message' => 'Unable to validate',
                'erros' => $validated->errors(),
                'status' => 400
            ];

            return $data;
        }

        $bonus = Bonus::create($request->all());

        $data = [
            'message' => 'Bonus added successfully',
            'record' => $bonus,
            'status' => 200
        ];

        return $data;
    }

    public function update(Request $request, $id) {
        $validated = Validator::make($request->all(), [
            'employee_dui' => 'required',
            'amount' => 'required'
        ]);

        if($validated->fails()) {
            $data = [
                'message' => 'Unable to validate',
                'erros' => $validated->errors(),
                'status' => 400
            ];

            return $data;
        }

        $bonus = Bonus::find($id);

        if(!$bonus) {
            $data = [
                'message' => 'Bonus not found',
                'status' => 400
            ];

            return $data;
        }

        $bonus->employee_dui = $request->get('employee_dui');
        $bonus->amount = $request->get('amount');
        $bonus->save();

        $data = [
            'message' => 'Bonus updated successfully',
            'record' => $bonus,
            'status' => 200
        ];

        return $data;
    }

    public function find($id) {
        $bonus = Bonus::find($id);

        if(!$bonus) {
            $data = [
                'message' => 'Bonus not found',
                'status' => 400
            ];

            return $data;
        }

        $data = [
            'message' => 'Bonus found',
            'record' => $bonus,
            'status' => 200
        ];

        return $data;
    }
}
