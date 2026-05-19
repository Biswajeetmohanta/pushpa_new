@extends('admin.layouts.app')

@section('title', 'Manage Sectors')
@section('page-title', 'Project Sectors')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <p class="text-sm text-slate-500">Create, update, and sort project sectors dynamically to categorize your featured works.</p>
    </div>
    <a href="{{ route('admin.sectors.create') }}" class="inline-flex items-center gap-2 bg-[#0f2343] hover:bg-primary text-white font-semibold px-4 py-2.5 rounded-lg shadow-sm hover:shadow-md transition-all text-sm flex-shrink-0">
        <i data-lucide="plus" class="w-4 h-4"></i>
        <span>Add New Sector</span>
    </a>
</div>

<!-- Desktop Table View -->
<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden hidden md:block">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                    <th class="px-6 py-4">Sector Name</th>
                    <th class="px-6 py-4 text-center">Status</th>
                    <th class="px-6 py-4 text-center">Order</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm">
                @forelse($sectors as $sector)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="font-bold text-slate-800">{{ $sector->name }}</span>
                        </td>
                        <td class="px-6 py-4 text-center whitespace-nowrap">
                            @if($sector->is_active)
                                <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">Active</span>
                            @else
                                <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-400">Hidden</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center whitespace-nowrap text-slate-500">{{ $sector->sort_order }}</td>
                        <td class="px-6 py-4 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.sectors.edit', $sector) }}" class="p-2 text-slate-600 hover:text-primary hover:bg-slate-100 rounded-lg transition-colors" title="Edit">
                                    <i data-lucide="edit-3" class="w-4 h-4"></i>
                                </a>
                                <form action="{{ route('admin.sectors.destroy', $sector) }}" method="POST" class="inline" onsubmit="confirmDelete(event, this)">
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
                        <td colspan="4" class="px-6 py-12 text-center text-slate-400">
                            <div class="flex flex-col items-center justify-center gap-2">
                                <i data-lucide="folder" class="w-8 h-8 text-slate-300"></i>
                                <span>No sectors found. Create one to get started!</span>
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
    @forelse($sectors as $sector)
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <div class="font-bold text-slate-800 text-sm">{{ $sector->name }}</div>
                    <div class="flex items-center gap-2 mt-2">
                        <span class="text-xs text-slate-400">Order: {{ $sector->sort_order }}</span>
                        @if($sector->is_active)
                            <span class="inline-flex px-2 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-100 text-emerald-800">Active</span>
                        @else
                            <span class="inline-flex px-2 py-0.5 rounded-full text-[10px] font-semibold bg-slate-100 text-slate-400">Hidden</span>
                        @endif
                    </div>
                </div>
                <div class="flex items-center gap-1">
                    <a href="{{ route('admin.sectors.edit', $sector) }}" class="p-2 text-slate-600 hover:text-primary hover:bg-slate-100 rounded-lg transition-colors">
                        <i data-lucide="edit-3" class="w-4 h-4"></i>
                    </a>
                    <form action="{{ route('admin.sectors.destroy', $sector) }}" method="POST" onsubmit="confirmDelete(event, this)">
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
            <i data-lucide="folder" class="w-8 h-8 mx-auto mb-2 text-slate-300"></i>
            <p class="text-sm">No sectors found. Create one to get started!</p>
        </div>
    @endforelse
</div>
@endsection
