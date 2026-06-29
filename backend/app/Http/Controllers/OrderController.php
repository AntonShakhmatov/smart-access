<?php
namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller {
    public function store(Request $request) 
    {
        $visitor = new Visitor();
        $visitor->fill($request->all());
        $visitor->save();
    }
}