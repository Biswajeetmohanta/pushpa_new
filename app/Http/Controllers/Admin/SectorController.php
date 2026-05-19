<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sector;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    public function index()
    {
        $sectors = Sector::orderBy('sort_order')->get();
        return view('admin.sectors.index', compact('sectors'));
    }

    public function create()
    {
        return view('admin.sectors.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:sectors,name'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = $request->has('is_active');

        $sector = Sector::create($data);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'sector' => $sector
            ]);
        }

        return redirect()->route('admin.sectors.index')->with('success', 'Sector created successfully.');
    }

    public function edit(Sector $sector)
    {
        return view('admin.sectors.edit', compact('sector'));
    }

    public function update(Request $request, Sector $sector)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:sectors,name,' . $sector->id],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = $request->has('is_active');

        $sector->update($data);

        return redirect()->route('admin.sectors.index')->with('success', 'Sector updated successfully.');
    }

    public function destroy(Sector $sector)
    {
        $sector->delete();
        return redirect()->route('admin.sectors.index')->with('success', 'Sector deleted successfully.');
    }
}
