<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\VisitService;
use App\Http\Requests\StoreVisitRequest;

class VisitController extends Controller {
    public function store(StoreVisitRequest $request, VisitService $visitService) {
        $visit = $visitService->registerVisit($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Visit have been registered.',
            'visit_id' => $visit->id
        ], 201);
    }
}
