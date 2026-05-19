@extends('admin.layouts.app')

@section('title', 'Manage Testimonials')
@section('page-title', 'Client Testimonials')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <p class="text-sm text-slate-500">Edit and curate client feedback shown in our home carousel.</p>
    </div>
    <a href="{{ route('admin.testimonials.create') }}" class="inline-flex items-center gap-2 bg-[#0f2343] hover:bg-primary text-white font-semibold px-4 py-2.5 rounded-lg shadow-sm hover:shadow-md transition-all text-sm flex-shrink-0">
        <i data-lucide="plus" class="w-4 h-4"></i>
        <span>Add New Testimonial</span>
    </a>
</div>

<!-- Desktop Table View -->
<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden hidden md:block">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                    <th class="px-6 py-4">Client</th>
                    <th class="px-6 py-4">Designation</th>
                    <th class="px-6 py-4">Rating</th>
                    <th class="px-6 py-4">Quote</th>
                    <th class="px-6 py-4 text-center">Status</th>
                    <th class="px-6 py-4 text-center">Order</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm">
                @forelse($testimonials as $testimonial)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                @if($testimonial->image)
                                    <img src="{{ $testimonial->image }}" alt="{{ $testimonial->name }}" class="w-10 h-10 object-cover rounded-full border border-slate-200">
                                @else
                                    <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 border border-slate-200">
                                        <i data-lucide="user" class="w-4 h-4"></i>
                                    </div>
                                @endif
                                <div class="font-bold text-slate-800">{{ $testimonial->name }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-slate-700 font-medium text-xs">{{ $testimonial->role }}</div>
                            <div class="text-[10px] text-slate-400 mt-0.5">{{ $testimonial->company }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex text-amber-400 gap-0.5">
                                @for($i=1; $i<=5; $i++)
                                    @if($i <= $testimonial->rating)
                                        <i data-lucide="star" class="w-3.5 h-3.5 fill-current"></i>
                                    @else
                                        <i data-lucide="star" class="w-3.5 h-3.5 text-slate-200"></i>
                                    @endif
                                @endfor
                            </div>
                        </td>
                        <td class="px-6 py-4 max-w-xs">
                            <div class="text-xs text-slate-400 line-clamp-2 mt-1">"{{ $testimonial->text }}"</div>
                        </td>
                        <td class="px-6 py-4 text-center whitespace-nowrap">
                            @if($testimonial->is_active)
                                <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">Active</span>
                            @else
                                <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-400">Hidden</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center whitespace-nowrap text-slate-500">{{ $testimonial->sort_order }}</td>
                        <td class="px-6 py-4 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="p-2 text-slate-600 hover:text-primary hover:bg-slate-100 rounded-lg transition-colors" title="Edit">
                                    <i data-lucide="edit-3" class="w-4 h-4"></i>
                                </a>
                                <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" class="inline" onsubmit="confirmDelete(event, this)">
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
                        <td colspan="7" class="px-6 py-12 text-center text-slate-400">
                            <div class="flex flex-col items-center justify-center gap-2">
                                <i data-lucide="message-square" class="w-8 h-8 text-slate-300"></i>
                                <span>No testimonials found. Create one to get started!</span>
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
    @forelse($testimonials as $testimonial)
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4">
            <div class="flex items-start gap-3">
                @if($testimonial->image)
                    <img src="{{ $testimonial->image }}" alt="{{ $testimonial->name }}" class="w-12 h-12 object-cover rounded-full border border-slate-200 flex-shrink-0">
                @else
                    <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 border border-slate-200 flex-shrink-0">
                        <i data-lucide="user" class="w-5 h-5"></i>
                    </div>
                @endif
                <div class="flex-1 min-w-0">
                    <div class="font-bold text-slate-800 text-sm truncate">{{ $testimonial->name }}</div>
                    <div class="text-[11px] text-slate-500 truncate">{{ $testimonial->role }} &bull; {{ $testimonial->company }}</div>
                    
                    <div class="flex text-amber-400 gap-0.5 mt-1.5">
                        @for($i=1; $i<=5; $i++)
                            @if($i <= $testimonial->rating)
                                <i data-lucide="star" class="w-3 h-3 fill-current"></i>
                            @else
                                <i data-lucide="star" class="w-3 h-3 text-slate-200"></i>
                            @endif
                        @endfor
                    </div>

                    <div class="text-xs text-slate-400 italic mt-2 line-clamp-3">"{{ $testimonial->text }}"</div>

                    <div class="flex items-center gap-2 mt-3">
                        <span class="text-xs text-slate-400">Order: {{ $testimonial->sort_order }}</span>
                        @if($testimonial->is_active)
                            <span class="inline-flex px-2 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-100 text-emerald-800">Active</span>
                        @else
                            <span class="inline-flex px-2 py-0.5 rounded-full text-[10px] font-semibold bg-slate-100 text-slate-400">Hidden</span>
                        @endif
                    </div>
                </div>
                <div class="flex flex-col gap-1.5 flex-shrink-0">
                    <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="p-2 text-slate-600 hover:text-primary hover:bg-slate-100 rounded-lg transition-colors">
                        <i data-lucide="edit-3" class="w-4 h-4"></i>
                    </a>
                    <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" onsubmit="confirmDelete(event, this)">
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
            <i data-lucide="message-square" class="w-8 h-8 mx-auto mb-2 text-slate-300"></i>
            <p class="text-sm">No testimonials found. Create one to get started!</p>
        </div>
    @endforelse
</div>
@endsection
