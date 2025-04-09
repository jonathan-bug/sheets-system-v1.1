<?php

namespace App\Utility\Strategy\Consumer;

use Illuminate\Support\Facades\DB;
use App\Utility\Strategy\Behavior\IBehavior;

abstract class Consumer {
    protected IBehavior $behavior;

    public function changeBehavior(IBehavior $behavior) {
        $this->behavior = $behavior;
    }

    public function triggerAction($data) {
        $employees = DB::table('employees')
                       ->get();

        for($i = 0; $i < $employees->count(); $i++) {
            $salary = null;
            
            try {
                $salary = DB::table('salaries')
                            ->select('amount')
                            ->where('employee_dui', '=', $employees[$i]->dui)
                            ->orderByDesc('last')
                            ->first()->amount;
            }catch(\Exception) {
                $salary = 0;
            }
            
            $extra_day_hour = DB::table('hours')
                                ->select('hour')
                                ->where('employee_dui', '=', $employees[$i]->dui)
                                ->where('period_id', '=', $data)
                                ->where('type', '=', 1)
                                ->sum('hour');
            $extra_night_hour = DB::table('hours')
                                  ->select('hour')
                                  ->where('employee_dui', '=', $employees[$i]->dui)
                                  ->where('period_id', '=', $data)
                                  ->where('type', '=', 2)
                                  ->sum('hour');
            $night_hour = DB::table('hours')
                            ->select('hour')
                            ->where('employee_dui', '=', $employees[$i]->dui)
                            ->where('period_id', '=', $data)
                            ->where('type', '=', 3)
                            ->sum('hour');

            $bonuses = DB::table('bonus')
                         ->select('amount')
                         ->where('employee_dui', '=', $employees[$i]->dui)
                         ->where('period_id', '=', $data)
                         ->where('amount', '>=', 0)
                         ->sum('amount');
            $no_bonuses = DB::table('bonus')
                            ->select('amount')
                            ->where('employee_dui', '=', $employees[$i]->dui)
                            ->where('period_id', '=', $data)
                            ->where('amount', '<', 0)
                            ->sum('amount');

            $annuals = DB::table('histories')
                         ->select('id')
                         ->where('employee_dui', '=', $employees[$i]->dui)
                         ->where('period_id', '=', $data);

            $employee = (array)$employees[$i];
            $employee['salary'] = $salary;
            $employee['extra_day_hour'] = $extra_day_hour;
            $employee['extra_night_hour'] = $extra_night_hour;
            $employee['night_hour'] = $night_hour;
            $employee['bonuses'] = $bonuses;
            $employee['no_bonuses'] = $no_bonuses;

            if($annuals->count() != 0) {
                $employee['histories'] = true;
            }else {
                $employee['histories'] = false;
            }

            $employees[$i] = (object)$employee;
        }

        return $this->behavior->action($employees);
    }
}
