<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Period;

class PeriodController extends Controller
{
    public function page() {
        return view('pages.periods.index');
    }

    public function index() {
        $periods = Period::all();

        return $periods;
    }

    public function store(Request $request) {
        $validated = Validator::make($request->all(), [
            'month' => 'required',
            'year' => 'required'
        ]);

        if($validated->fails()) {
            $data = [
                'message' => 'Unable to validate',
                'errors' => $validated->errors(),
                'status' => 400
            ];

            return $data;
        }

        $record = Period::create($request->all());
        
        $data = [
            'message' => 'Period added successfully',
            'record' => $record,
            'status' => 200
        ];

        return $data;
    }

    public function destroy($id) {
        $period = Period::find($id);
        $period->delete();

        $data = [
            'message' => 'Period deleted',
            'status' => 200
        ];

        return $data;
    }

    public function update(Request $request, $id) {
        $validated = Validator::make($request->all(), [
            'month' => 'required',
            'year' => 'required'
        ]);

        if($validated->fails()) {
            $data = [
                'message' => 'Unable to validate',
                'errors' => $validated->errors(),
                'status' => 400
            ];

            return $data;
        }

        $period = Period::find($id);

        if(!$period) {
            $data = [
                'message' => 'Period not found',
                'status' => 400
            ];

            return $data;
        }

        $period->month = $request->get('month');
        $period->year = $request->get('year');
        $period->save();

        $data = [
            'message' => 'Period updated successfully',
            'record' => $period,
            'status' => 200
        ];

        return $data;
    }

    public function find($id) {
        $period = Period::find($id);

        if(!$period) {
            $data = [
                'message' => 'Period not found',
                'status' => 400
            ];

            return $data;
        }

        $data = [
            'message' => 'Period found',
            'record' => $period,
            'status' => 200
        ];

        return $data;
    }
}
