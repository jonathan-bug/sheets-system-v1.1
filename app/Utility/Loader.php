<?php

namespace App\Utility;

use App\Models\Period;
use Exception;

class Loader {
    public static function load() {
        // if the period is not loaded 
        if(!session('period')) {
            // load the period
            $period = Period::all()->sortBy('last')->first();

            // check if the period exists
            if($period) {
                // if exists save it to the session
                session(['period' => $period]);

                return true; // true if it was loaded
            }

            return false;
        }

        return false;
    }

    // reload the period
    public static function reload() {
        try {
            $period = Period::all()->sortBy('last')->first();

            session(['period' => $period]);
        }catch(Exception) {}
    }
}
