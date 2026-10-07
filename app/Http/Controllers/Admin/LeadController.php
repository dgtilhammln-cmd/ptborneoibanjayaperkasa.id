<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        $query = Lead::query()->latest();

        // 1. Status Filter
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // 2. Date Range Filter
        $period = $request->get('period', 'all');
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        if ($period === '7_days') {
            $query->where('created_at', '>=', Carbon::now()->subDays(7));
        } elseif ($period === '30_days') {
            $query->where('created_at', '>=', Carbon::now()->subDays(30));
        } elseif ($period === '90_days') {
            $query->where('created_at', '>=', Carbon::now()->subDays(90));
        } elseif ($period === '1_year') {
            $query->where('created_at', '>=', Carbon::now()->subYear());
        } elseif ($period === 'custom') {
            if ($startDate && $endDate) {
                $query->whereBetween('created_at', [
                    Carbon::parse($startDate)->startOfDay(),
                    Carbon::parse($endDate)->endOfDay()
                ]);
            } elseif ($startDate) {
                $query->where('created_at', '>=', Carbon::parse($startDate)->startOfDay());
            } elseif ($endDate) {
                $query->where('created_at', '<=', Carbon::parse($endDate)->endOfDay());
            }
        }

        // 3. Search Query
        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('whatsapp_number', 'like', "%{$search}%")
                  ->orWhere('company_location', 'like', "%{$search}%")
                  ->orWhere('requirements', 'like', "%{$search}%")
                  ->orWhere('utm_source', 'like', "%{$search}%")
                  ->orWhere('utm_medium', 'like', "%{$search}%")
                  ->orWhere('utm_campaign', 'like', "%{$search}%");
            });
        }

        // 4. Calculate Stat Counts for Selected Period
        $statsBaseQuery = Lead::query();
        if ($period === '7_days') {
            $statsBaseQuery->where('created_at', '>=', Carbon::now()->subDays(7));
        } elseif ($period === '30_days') {
            $statsBaseQuery->where('created_at', '>=', Carbon::now()->subDays(30));
        } elseif ($period === '90_days') {
            $statsBaseQuery->where('created_at', '>=', Carbon::now()->subDays(90));
        } elseif ($period === '1_year') {
            $statsBaseQuery->where('created_at', '>=', Carbon::now()->subYear());
        } elseif ($period === 'custom') {
            if ($startDate && $endDate) {
                $statsBaseQuery->whereBetween('created_at', [
                    Carbon::parse($startDate)->startOfDay(),
                    Carbon::parse($endDate)->endOfDay()
                ]);
            } elseif ($startDate) {
                $statsBaseQuery->where('created_at', '>=', Carbon::parse($startDate)->startOfDay());
            } elseif ($endDate) {
                $statsBaseQuery->where('created_at', '<=', Carbon::parse($endDate)->endOfDay());
            }
        }

        $allLeadsCount  = (clone $statsBaseQuery)->count();
        $newLeadsCount  = (clone $statsBaseQuery)->where('status', 'new')->count();
        $contactedCount = (clone $statsBaseQuery)->where('status', 'contacted')->count();
        $closedCount    = (clone $statsBaseQuery)->where('status', 'closed')->count();

        $leads = $query->paginate(15)->withQueryString();

        return view('admin.leads.index', compact(
            'leads',
            'allLeadsCount',
            'newLeadsCount',
            'contactedCount',
            'closedCount',
            'period',
            'startDate',
            'endDate'
        ));
    }

    public function updateStatus(Request $request, Lead $lead)
    {
        $request->validate([
            'status' => 'required|in:new,contacted,closed'
        ]);

        $lead->update(['status' => $request->status]);

        if ($request->expectsJson() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Status lead berhasil diperbarui.',
                'status' => $lead->status
            ]);
        }

        return redirect()->back()->with('success', 'Status lead berhasil diperbarui.');
    }

    public function destroy(Lead $lead)
    {
        $lead->delete();
        return redirect()->back()->with('success', 'Lead berhasil dihapus.');
    }
}

