@extends('admin.layouts.app')

@section('title', 'Manage Certifications')
@section('page-title', 'Certifications & Standards')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <p class="text-sm text-slate-500">Manage ISO certificates and standard credentials visible on the website.</p>
    </div>
    <a href="{{ route('admin.certifications.create') }}" class="inline-flex items-center gap-2 bg-[#0f2343] hover:bg-primary text-white font-semibold px-4 py-2.5 rounded-lg shadow-sm hover:shadow-md transition-all text-sm flex-shrink-0">
        <i data-lucide="plus" class="w-4 h-4"></i>
        <span>Add Certification</span>
    </a>
</div>

<!-- Desktop Table View -->
<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden hidden md:block">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                    <th class="px-6 py-4">Image/Badge</th>
                    <th class="px-6 py-4">Title</th>
                    <th class="px-6 py-4">Description</th>
                    <th class="px-6 py-4 text-center">Status</th>
                    <th class="px-6 py-4 text-center">Order</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm">
                @forelse($certifications as $cert)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($cert->image)
                                <a href="{{ asset($cert->image) }}" target="_blank" title="Click to view in new tab" class="cursor-pointer">
                                    <img src="{{ asset($cert->image) }}" alt="{{ $cert->title }}" class="w-12 h-12 object-cover rounded-lg border border-slate-200 hover:opacity-80 transition-opacity">
                                </a>
                            @else
                                <div class="w-12 h-12 rounded-lg bg-slate-100 flex items-center justify-center text-slate-400 border border-slate-200">
                                    <i data-lucide="award" class="w-5 h-5"></i>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="font-bold text-slate-800">{{ $cert->title }}</div>
                        </td>
                        <td class="px-6 py-4 max-w-xs">
                            <div class="text-xs text-slate-400 mt-1 line-clamp-2">{{ $cert->description }}</div>
                        </td>
                        <td class="px-6 py-4 text-center whitespace-nowrap">
                            @if($cert->is_active)
                                <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">Active</span>
                            @else
                                <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-400">Hidden</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center whitespace-nowrap text-slate-500">{{ $cert->sort_order }}</td>
                        <td class="px-6 py-4 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.certifications.edit', $cert) }}" class="p-2 text-slate-600 hover:text-primary hover:bg-slate-100 rounded-lg transition-colors" title="Edit">
                                    <i data-lucide="edit-3" class="w-4 h-4"></i>
                                </a>
                                <form action="{{ route('admin.certifications.destroy', $cert) }}" method="POST" class="inline" onsubmit="confirmDelete(event, this)">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg transition-colors" title="Delete">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-slate-400">
                            <div class="flex flex-col items-center justify-center gap-2">
                                <i data-lucide="award" class="w-8 h-8 text-slate-300"></i>
                                <span>No certifications found. Create one to get started!</span>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Mobile Card View -->
<div class="md:hidden space-y-4">
    @forelse($certifications as $cert)
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4">
            <div class="flex items-start gap-3">
                @if($cert->image)
                    <a href="{{ asset($cert->image) }}" target="_blank" title="Click to view in new tab" class="cursor-pointer">
                        <img src="{{ asset($cert->image) }}" alt="{{ $cert->title }}" class="w-12 h-12 object-cover rounded-lg border border-slate-200 flex-shrink-0 hover:opacity-80 transition-opacity">
                    </a>
                @else
                    <div class="w-12 h-12 rounded-lg bg-slate-100 flex items-center justify-center text-slate-400 border border-slate-200 flex-shrink-0">
                        <i data-lucide="award" class="w-5 h-5"></i>
                    </div>
                @endif
                <div class="flex-1 min-w-0">
                    <div class="font-bold text-slate-800 text-sm truncate">{{ $cert->title }}</div>
                    <div class="text-xs text-slate-400 mt-1 line-clamp-2">{{ $cert->description }}</div>
                    <div class="flex items-center gap-2 mt-3">
                        <span class="text-xs text-slate-400">Order: {{ $cert->sort_order }}</span>
                        @if($cert->is_active)
                            <span class="inline-flex px-2 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-100 text-emerald-800">Active</span>
                        @else
                            <span class="inline-flex px-2 py-0.5 rounded-full text-[10px] font-semibold bg-slate-100 text-slate-400">Hidden</span>
                        @endif
                    </div>
                </div>
                <div class="flex flex-col gap-1.5 flex-shrink-0">
                    <a href="{{ route('admin.certifications.edit', $cert) }}" class="p-2 text-slate-600 hover:text-primary hover:bg-slate-100 rounded-lg transition-colors">
                        <i data-lucide="edit-3" class="w-4 h-4"></i>
                    </a>
                    <form action="{{ route('admin.certifications.destroy', $cert) }}" method="POST" onsubmit="confirmDelete(event, this)">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg transition-colors">
                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8 text-center text-slate-400">
            <i data-lucide="award" class="w-8 h-8 mx-auto mb-2 text-slate-300"></i>
            <p class="text-sm">No certifications found. Create one to get started!</p>
        </div>
    @endforelse
</div>
@endsection
