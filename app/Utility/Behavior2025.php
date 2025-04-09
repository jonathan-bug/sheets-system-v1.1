<?php

namespace App\Utility;

use App\Utility\Strategy\Behavior\IBehavior;
use Illuminate\Support\Carbon;

class Behavior2025 implements IBehavior {
    public function action($data) {
        for($i = 0; $i < $data->count(); $i++) {
            $employee = (array)$data[$i];

            $salaryByDay = $employee['salary'] / 30;
            $salaryByHour = $salaryByDay / 8;

            $today = new Carbon();

            // hours data
            $employee['v_extra_day_hour'] = 2 * $employee['extra_day_hour'] * $salaryByHour;
            $employee['v_extra_night_hour'] = 2.5 * $employee['extra_night_hour'] * $salaryByHour;
            $employee['v_night_hour'] = 0.25 * $employee['night_hour'] * $salaryByHour;

            $employee['v_vacation'] = 0;
            $employee['v_aguinald'] = 0;

            if($employee['histories']) {
                $employee['v_vacation'] = ($employee['salary'] / 30) * 15 * 0.3;
                
                $years = $today->year - (new Carbon($employee['hiring_date']))->year;

                if($years >= 1 && $years < 3) {
                    $employee['v_aguinald'] = $employee['salary'] / 2;
                }else if($years >= 3 && $years < 10) {
                    $employee['v_aguinald'] = ($employee['salary'] / 30) * 19;
                }else if($years >= 10) {
                    $employee['v_aguinald'] = ($employee['salary'] / 30) * 21;
                }
            }
                        
            $employee['calculable'] = $employee['salary'] +
                                      $employee['v_extra_day_hour'] +
                                      $employee['v_extra_night_hour'] +
                                      $employee['v_night_hour'] +
                                      $employee['v_vacation'];

            // afp and isss
            $employee['v_emp_afp'] = 0.0725 * $employee['calculable'];
            $employee['v_pat_afp'] = 0.0875 * $employee['calculable'];

            if($employee['calculable'] >= 1000) {
                $employee['v_emp_isss'] = 0.03 * 1000;
                $employee['v_pat_isss'] = 0.075 * 1000;
            }else {
                $employee['v_emp_isss'] = 0.03 * $employee['calculable'];
                $employee['v_pat_isss'] = 0.075 * $employee['calculable'];
            }

            // totals
            $employee['v_unique_total'] = $employee['v_emp_isss'] +
                                          $employee['v_emp_afp'] +
                                          $employee['v_pat_isss'] +
                                          $employee['v_pat_afp'];

            $employee['v_employee_total'] = $employee['calculable'] -
                                            $employee['v_emp_isss'] -
                                            $employee['v_emp_afp'] +
                                            $employee['bonuses'] +
                                            $employee['no_bonuses'];

            $data[$i] = (object)$employee;
        }
        
        return $data;
    }
}
