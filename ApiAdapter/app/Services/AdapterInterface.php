<?php

namespace App\Services;

use Illuminate\Http\Request;

interface AdapterInterface
{
    public function parse(Request $request);
}
