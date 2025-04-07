<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function page() {
        return view('pages.employees.index');
    }

    public function index() {
        $employees = Employee::all();

        return $employees;
    }

    public function destroy(Request $request) {
        $employee = Employee::find($request->get('dui'));

        if(!$employee) {
            $data = [
                'message' => 'Employee not found',
                'status' => 400
            ];

            return $data;
        }

        $employee->delete();

        $data = [
            'message' => 'Employee deleted',
            'status' => 200
        ];

        return $data;
    }

    public function store(Request $request) {
        $validated = Validator::make($request->all(), [
            'dui' => 'required',
            'first_name' => 'required',
            'second_name' => 'required',
            'first_lastname' => 'required',
            'second_lastname' => 'required',
            'birth_date' => 'required',
            'hiring_date' => 'required'
        ]);

        if($validated->fails()) {
            $data = [
                'message' => 'Unable to validate',
                'errors' => $validated->errors(),
                'status' => 400
            ];

            return $data;
        }

        // adding one year to the calculated date
        $calculatedDate = new Carbon($request->get('birth_date'));
        $calculatedDate->addYear();

        $record = $request->all();
        $record['calculated_date'] = $calculatedDate->format('Y-m-d');
        $record = Employee::create($record); // getting the last created

        $data = [
            'message' => 'Employee added successfully',
            'record' => $record,
            'status' => 200
        ];
        
        return $data;
    }

    public function find(Request $request) {
        $employee = Employee::find($request->get('dui'));

        if(!$employee) {
            $data = [
                'message' => 'Employee not found',
                'status' => 400
            ];

            return $data;
        }

        $data = [
            'message' => 'Employee found',
            'record' => $employee,
            'status' => 200
        ];

        return $data;
    }

    public function update(Request $request) {
        $validated = Validator::make($request->all(), [
            'dui' => 'required',
            'first_name' => 'required',
            'second_name' => 'required',
            'first_lastname' => 'required',
            'second_lastname' => 'required',
            'birth_date' => 'required',
            'hiring_date' => 'required'
        ]);

        if($validated->fails()) {
            $data = [
                'message' => 'Unable to validate',
                'errors' => $validated->errors(),
                'status' => 400
            ];

            return $data;
        }

        $employee = Employee::find($request->get('dui'));

        if(!$employee) {
            $data = [
                'message' => 'Employee not found',
                'status' => 400
            ];

            return $data;
        }

        $employee->first_name = $request->get('first_name');
        $employee->second_name = $request->get('second_name');
        $employee->first_lastname = $request->get('first_lastname');
        $employee->second_lastname = $request->get('second_lastname');
        $employee->birth_date = $request->get('birth_date');
        $employee->hiring_date = $request->get('hiring_date');
        $employee->save();

        $data = [
            'message' => 'Employee updated successfully',
            'record' => $employee,
            'status' => 200
        ];

        return $data;
    }
}
