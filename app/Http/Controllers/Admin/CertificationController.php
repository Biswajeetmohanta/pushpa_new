<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CertificationController extends Controller
{
    public function index()
    {
        $certifications = Certification::orderBy('sort_order')->get();
        return view('admin.certifications.index', compact('certifications'));
    }

    public function create()
    {
        return view('admin.certifications.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description_heading' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif', 'max:5120'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            if (!File::exists(public_path('uploads'))) {
                File::makeDirectory(public_path('uploads'), 0755, true);
            }
            
            $file->move(public_path('uploads'), $filename);
            $data['image'] = '/uploads/' . $filename;
        }

        Certification::create($data);

        return redirect()->route('admin.certifications.index')->with('success', 'Certification created successfully.');
    }

    public function edit(Certification $certification)
    {
        return view('admin.certifications.edit', compact('certification'));
    }

    public function update(Request $request, Certification $certification)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description_heading' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif', 'max:5120'],
            'sort_order' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            if ($certification->image && File::exists(public_path($certification->image))) {
                File::delete(public_path($certification->image));
            }

            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            if (!File::exists(public_path('uploads'))) {
                File::makeDirectory(public_path('uploads'), 0755, true);
            }
            
            $file->move(public_path('uploads'), $filename);
            $data['image'] = '/uploads/' . $filename;
        }

        $certification->update($data);

        return redirect()->route('admin.certifications.index')->with('success', 'Certification updated successfully.');
    }

    public function destroy(Certification $certification)
    {
        if ($certification->image && File::exists(public_path($certification->image))) {
            File::delete(public_path($certification->image));
        }

        $certification->delete();

        return redirect()->route('admin.certifications.index')->with('success', 'Certification deleted successfully.');
    }
}
