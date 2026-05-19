<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('sort_order')->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'icon' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'features' => ['nullable', 'string'], // Raw textarea input split by newline
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = $request->has('is_active');
        
        // Convert features newline string into JSON array
        if (!empty($data['features'])) {
            $featureLines = array_filter(array_map('trim', explode("\n", $data['features'])));
            $data['features'] = json_encode(array_values($featureLines));
        } else {
            $data['features'] = json_encode([]);
        }

        Service::create($data);

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    public function edit(Service $service)
    {
        // Decode features back to newlines for text area
        $features = '';
        if ($service->features) {
            $decoded = json_decode($service->features, true);
            if (is_array($decoded)) {
                $features = implode("\n", $decoded);
            }
        }
        return view('admin.services.edit', compact('service', 'features'));
    }

    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'icon' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'features' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = $request->has('is_active');

        if (!empty($data['features'])) {
            $featureLines = array_filter(array_map('trim', explode("\n", $data['features'])));
            $data['features'] = json_encode(array_values($featureLines));
        } else {
            $data['features'] = json_encode([]);
        }

        $service->update($data);

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }
}
