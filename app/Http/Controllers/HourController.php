<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Employee;
use App\Models\Hour;

class HourController extends Controller
{
    // obtener el indice con la pagina en el url de la request
    public function page($dui) {
        $employee = Employee::find($dui);

        return view('pages.hours.index')->with(['employee' => $employee]);
    }
    
    public function index($dui) {
        $employee = Employee::find($dui);
        $hours = $employee->hours;

        return $hours;
    }

    public function destroy($id) {
        $hour = Hour::find($id);
        $hour->delete();

        $data = [
            'message' => 'Hour deleted successfully',
            'status' => 200
        ];

        return $data;
    }

    public function store(Request $request) {
        $validated = Validator::make($request->all(), [
            'employee_dui' => 'required',
            'hour' => 'required',
            'type' => 'required'
        ]);

        if($validated->fails()) {
            $data = [
                'message' => 'Unable to validate',
                'errors' => $validated->errors(),
                'status' => 400
            ];

            return $data;
        }

        $hour = Hour::create($request->all());

        $data = [
            'message' => 'Hour added successfully',
            'record' => $hour,
            'status' => 200
        ];

        return $data;
    }

    public function update(Request $request, $id) {
        $validated = Validator::make($request->all(), [
            'employee_dui' => 'required',
            'hour' => 'required',
            'type' => 'required'
        ]);

        if($validated->fails()) {
            $data = [
                'message' => 'Unable to validate',
                'errors' => $validated->errors(),
                'status' => 400
            ];

            return $data;
        }

        $hour = Hour::find($id);

        if(!$hour) {
            $data = [
                'message' => 'Hour not found',
                'status' => 400
            ];

            return $data;
        }

        $hour->employee_dui = $request->get('employee_dui');
        $hour->hour = $request->get('hour');
        $hour->type = $request->get('type');
        $hour->save();

        $data = [
            'message' => 'Hour updated successfully',
            'record' => $hour,
            'status' => 200
        ];

        return $data;
    }

    public function find($id) {
        $hour = Hour::find($id);

        if(!$hour) {
            $data = [
                'message' => 'Hour not found',
                'status' => 400
            ];

            return $data;
        }

        $data = [
            'message' => 'Hour found',
            'record' => $hour,
            'status' => 200
        ];

        return $data;
    }
}
