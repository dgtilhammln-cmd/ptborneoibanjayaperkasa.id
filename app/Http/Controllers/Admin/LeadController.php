<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        $query = Lead::query()->latest();

        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        $leads = $query->paginate(20);

        return view('admin.leads.index', compact('leads'));
    }

    public function updateStatus(Request $request, Lead $lead)
    {
        $request->validate([
            'status' => 'required|in:new,contacted,closed'
        ]);

        $lead->update(['status' => $request->status]);

        return redirect()->route('admin.leads.index')->with('success', 'Status lead berhasil diperbarui.');
    }

    public function destroy(Lead $lead)
    {
        $lead->delete();
        return redirect()->route('admin.leads.index')->with('success', 'Lead berhasil dihapus.');
    }
}
