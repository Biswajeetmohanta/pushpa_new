@extends('admin.layouts.app')

@section('title', 'Manage Services')
@section('page-title', 'Company Services')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <p class="text-sm text-slate-500">Add, edit, and configure the range of services provided by Pushpraj Construction.</p>
    </div>
    <a href="{{ route('admin.services.create') }}" class="inline-flex items-center gap-2 bg-[#0f2343] hover:bg-primary text-white font-semibold px-4 py-2.5 rounded-lg shadow-sm hover:shadow-md transition-all text-sm flex-shrink-0">
        <i data-lucide="plus" class="w-4 h-4"></i>
        <span>Add New Service</span>
    </a>
</div>

<!-- Desktop Table View -->
<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden hidden md:block">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                    <th class="px-6 py-4">Icon</th>
                    <th class="px-6 py-4">Service Details</th>
                    <th class="px-6 py-4">Key Features</th>
                    <th class="px-6 py-4 text-center">Status</th>
                    <th class="px-6 py-4 text-center">Order</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm">
                @forelse($services as $service)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="w-12 h-12 rounded-lg bg-primary/10 flex items-center justify-center text-primary">
                                <i data-lucide="{{ $service->icon ?? 'briefcase' }}" class="w-5 h-5"></i>
                            </div>
                        </td>
                        <td class="px-6 py-4 max-w-sm">
                            <div class="font-bold text-slate-800">{{ $service->title }}</div>
                            <div class="text-xs text-slate-400 mt-1 line-clamp-2">{{ $service->description }}</div>
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $features = json_decode($service->features, true);
                            @endphp
                            @if(is_array($features) && count($features) > 0)
                                <div class="flex flex-wrap gap-1">
                                    @foreach(array_slice($features, 0, 3) as $f)
                                        <span class="inline-flex px-2 py-0.5 rounded bg-slate-100 text-slate-600 text-[10px] font-medium">{{ $f }}</span>
                                    @endforeach
                                    @if(count($features) > 3)
                                        <span class="inline-flex px-2 py-0.5 rounded bg-slate-200 text-slate-600 text-[10px] font-bold">+{{ count($features) - 3 }}</span>
                                    @endif
                                </div>
                            @else
                                <span class="text-xs text-slate-400">No key features.</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center whitespace-nowrap">
                            @if($service->is_active)
                                <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">Active</span>
                            @else
                                <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-400">Hidden</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center whitespace-nowrap text-slate-500">{{ $service->sort_order }}</td>
                        <td class="px-6 py-4 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.services.edit', $service) }}" class="p-2 text-slate-600 hover:text-primary hover:bg-slate-100 rounded-lg transition-colors" title="Edit">
                                    <i data-lucide="edit-3" class="w-4 h-4"></i>
                                </a>
                                <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="inline" onsubmit="confirmDelete(event, this)">
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
                                <i data-lucide="briefcase" class="w-8 h-8 text-slate-300"></i>
                                <span>No services found. Create one to get started!</span>
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
    @forelse($services as $service)
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4">
            <div class="flex items-start gap-3">
                <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center text-primary flex-shrink-0">
                    <i data-lucide="{{ $service->icon ?? 'briefcase' }}" class="w-5 h-5"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="font-bold text-slate-800 text-sm truncate">{{ $service->title }}</div>
                    <div class="text-xs text-slate-400 mt-1 line-clamp-2">{{ $service->description }}</div>
                    
                    @php
                        $features = json_decode($service->features, true);
                    @endphp
                    @if(is_array($features) && count($features) > 0)
                        <div class="flex flex-wrap gap-1 mt-2.5">
                            @foreach(array_slice($features, 0, 3) as $f)
                                <span class="inline-flex px-2 py-0.5 rounded bg-slate-100 text-slate-600 text-[10px] font-medium truncate max-w-[100px]">{{ $f }}</span>
                            @endforeach
                            @if(count($features) > 3)
                                <span class="inline-flex px-2 py-0.5 rounded bg-slate-200 text-slate-600 text-[10px] font-bold">+{{ count($features) - 3 }}</span>
                            @endif
                        </div>
                    @endif

                    <div class="flex items-center gap-2 mt-3">
                        <span class="text-xs text-slate-400">Order: {{ $service->sort_order }}</span>
                        @if($service->is_active)
                            <span class="inline-flex px-2 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-100 text-emerald-800">Active</span>
                        @else
                            <span class="inline-flex px-2 py-0.5 rounded-full text-[10px] font-semibold bg-slate-100 text-slate-400">Hidden</span>
                        @endif
                    </div>
                </div>
                <div class="flex flex-col gap-1.5 flex-shrink-0">
                    <a href="{{ route('admin.services.edit', $service) }}" class="p-2 text-slate-600 hover:text-primary hover:bg-slate-100 rounded-lg transition-colors">
                        <i data-lucide="edit-3" class="w-4 h-4"></i>
                    </a>
                    <form action="{{ route('admin.services.destroy', $service) }}" method="POST" onsubmit="confirmDelete(event, this)">
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
            <i data-lucide="briefcase" class="w-8 h-8 mx-auto mb-2 text-slate-300"></i>
            <p class="text-sm">No services found. Create one to get started!</p>
        </div>
    @endforelse
</div>
@endsection
