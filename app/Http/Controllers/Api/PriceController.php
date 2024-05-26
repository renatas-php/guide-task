<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Server\ServerPriceService;
use App\Http\Requests\ServerPriceCountRequest;

class PriceController extends Controller {   
    
    private $serverPriceService;

    public function __construct(ServerPriceService $serverPriceService)
    {
        $this->serverPriceService = $serverPriceService;
    }

    public function getServerPrice(ServerPriceCountRequest $request)
    {   
        $finalPrice = $this->serverPriceService->countFinalServerPrice($request->domain, $request->emailSecurity, $request->plan, $request->serverCapacity);
        
        return response()->json([
            'data' => $finalPrice
        ]);
    }
}

