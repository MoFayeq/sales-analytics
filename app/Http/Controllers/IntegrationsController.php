<?php

namespace App\Http\Controllers;

use App\Services\IntegrationsService;
use Illuminate\Http\JsonResponse;

class IntegrationsController extends Controller
{
    protected IntegrationsService $integrationsService;
    public function __construct(IntegrationsService $integrationsService)
    {
        $this->integrationsService = $integrationsService;
    }

    public function analyzeOrders(): JsonResponse
    {
        $response = $this->integrationsService->analyzeLastOrders();
        return response()->json(['response' => $response]);
    }

    public function weatherPromotion(): JsonResponse
    {
        $recommendation = $this->integrationsService->weatherBasedPromotion();
        return response()->json(['promotion' => $recommendation]);
    }
}

