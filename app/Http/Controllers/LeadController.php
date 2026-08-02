<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'whatsapp_number' => 'required|string|max:20',
            'company_location' => 'nullable|string|max:255',
            'requirements' => 'nullable|string',
            'source_url' => 'nullable|string|max:1000',
            'utm_source' => 'nullable|string|max:255',
            'utm_medium' => 'nullable|string|max:255',
            'utm_campaign' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $lead = Lead::create($validator->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Lead saved successfully',
            'data' => $lead
        ], 201);
    }
}
