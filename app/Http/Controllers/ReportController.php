<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Jobs\GenerateReport;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::latest()->paginate(10);
        return view('reports.index', compact('reports'));
    }

    public function create()
    {
        return view('reports.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'parameters' => 'nullable|array',
            'parameters.categories' => 'nullable|array',
            'parameters.categories.*' => 'string',
            'parameters.min_quantity' => 'nullable|integer|min:0'
        ]);

        $report = Report::create($validated);

        // Dispatch the report generation job
        GenerateReport::dispatch($report);

        return redirect()->route('reports.index')
            ->with('success', 'Report generation has been queued. You will receive an email when it\'s ready.');
    }

    public function show(Report $report)
    {
        return view('reports.show', compact('report'));
    }
}
