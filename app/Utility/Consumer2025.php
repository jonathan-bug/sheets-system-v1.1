<?php

namespace App\Utility;

use App\Utility\Strategy\Consumer\Consumer;
use App\Utility\Behavior2025;

class Consumer2025 extends Consumer {
    public function __construct() {
        $this->behavior = new Behavior2025();
    }
}
