<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Server\Plan;

class PlanController extends Controller
{
    public function plans()
    {
        $items = Plan::active()->orderBy('title')->get();

        return response()->json([
            'data' => $items
        ]);
    }
}

