<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Visit;
use App\Models\Visitor;
use Illuminate\Http\Request;
use App\Jobs\ProcessOrder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;

class VisitsController extends Controller
{
    public function index()
    {
        return Visit::all();
    }

    public function checkOut(string $id)
    {
        $findId = Visitor::findOrFail($id);

        ProcessOrder::dispatch($findId);

        return response()->json(["message" => "Запрос принят в обработку"]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'qr_code' => 'required|string|max:255',
        ]);

        return Visitor::create($request->all());
    }

    public function show(string $id) {
        return Visitor::findOrFail($id);
    }   

    public function edit(string $id) {
        
    }

    public function update(Request $request, $id) {}

    public function destroy(string $id) {}
}
