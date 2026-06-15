<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Insurer;
use App\Models\Broker;
use App\Models\Agent;
use App\Models\ServiceProvider;
use Illuminate\Http\Request;

class TiramisCodeController extends Controller
{
    public function index()
    {
        $insurers = Insurer::latest()->get();
        $brokers = Broker::latest()->get();
        $agents = Agent::latest()->get();
        $providers = ServiceProvider::latest()->get();

        return view('admin.tiramis.codes.index', compact('insurers', 'brokers', 'agents', 'providers'));
    }

    public function update(Request $request, string $type, int $id)
    {
        $data = $request->validate([
            'company_code' => 'nullable|string|max:50',
            'sales_code' => 'nullable|string|max:50',
            'tiramis_enabled' => 'nullable|boolean',
        ]);

        $model = match ($type) {
            'insurer' => Insurer::findOrFail($id),
            'broker' => Broker::findOrFail($id),
            'agent' => Agent::findOrFail($id),
            'provider' => ServiceProvider::findOrFail($id),
            default => abort(404),
        };

        $model->update($data);

        return redirect()->back()->with('success', 'TIRAMIS codes updated successfully.');
    }

    public function toggle(Request $request, string $type, int $id)
    {
        $model = match ($type) {
            'insurer' => Insurer::findOrFail($id),
            'broker' => Broker::findOrFail($id),
            'agent' => Agent::findOrFail($id),
            default => abort(404),
        };

        $enabled = $request->boolean('tiramis_enabled', !$model->tiramis_enabled);
        $model->update(['tiramis_enabled' => $enabled]);

        return response()->json(['success' => true, 'tiramis_enabled' => $enabled]);
    }

    public function assignForm()
    {
        $insurers = Insurer::whereNull('company_code')->orWhere('company_code', '')->get();
        $brokers = Broker::whereNull('sales_code')->orWhere('sales_code', '')->get();
        $agents = Agent::whereNull('sales_code')->orWhere('sales_code', '')->get();
        $providers = ServiceProvider::whereNull('company_code')->orWhere('company_code', '')->get();

        return view('admin.tiramis.codes.assign', compact('insurers', 'brokers', 'agents', 'providers'));
    }

    public function assign(Request $request)
    {
        $request->validate([
            'entity_type' => 'required|in:insurer,broker,agent,provider',
            'entity_ids' => 'required|array',
            'entity_ids.*' => 'integer',
            'code_prefix' => 'required|string|max:10',
        ]);

        $model = match ($request->entity_type) {
            'insurer' => Insurer::class,
            'broker' => Broker::class,
            'agent' => Agent::class,
            'provider' => ServiceProvider::class,
        };

        $codeColumn = in_array($request->entity_type, ['insurer', 'provider']) ? 'company_code' : 'sales_code';
        $count = 0;

        foreach ($request->entity_ids as $id) {
            $entity = $model::find($id);
            if ($entity && empty($entity->$codeColumn)) {
                $entity->update([
                    $codeColumn => $request->code_prefix . '-' . strtoupper(substr($request->entity_type, 0, 3)) . '-' . str_pad($id, 4, '0', STR_PAD_LEFT),
                ]);
                $count++;
            }
        }

        return redirect()->route('admin.tiramis.codes.index')->with('success', "$count codes assigned successfully.");
    }

    public function export()
    {
        $headers = ['Entity Type', 'Name', 'Identifier', 'Company Code', 'Sales Code', 'TIRAMIS Enabled'];
        $rows = [];

        foreach (Insurer::all() as $e) {
            $rows[] = ['Insurer', $e->insurer_name, $e->insurer_code, $e->company_code ?? '', $e->sales_code ?? '', $e->tiramis_enabled ? 'Yes' : 'No'];
        }
        foreach (Broker::all() as $e) {
            $rows[] = ['Broker', $e->company_name, $e->broker_number, $e->company_code ?? '', $e->sales_code ?? '', $e->tiramis_enabled ? 'Yes' : 'No'];
        }
        foreach (Agent::all() as $e) {
            $rows[] = ['Agent', $e->first_name . ' ' . $e->last_name, $e->agent_number, $e->company_code ?? '', $e->sales_code ?? '', $e->tiramis_enabled ? 'Yes' : 'No'];
        }
        foreach (ServiceProvider::all() as $e) {
            $rows[] = ['Service Provider', $e->company_name, $e->provider_number, $e->company_code ?? '', $e->sales_code ?? '', 'N/A'];
        }

        $callback = function () use ($headers, $rows) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $headers);
            foreach ($rows as $row) fputcsv($file, $row);
            fclose($file);
        };

        return response()->stream($callback, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="tiramis-codes-export.csv"',
        ]);
    }
}
