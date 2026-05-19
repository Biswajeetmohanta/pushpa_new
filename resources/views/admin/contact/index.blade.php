@extends('admin.layouts.app')

@section('title', 'Manage Inbox')
@section('page-title', 'Visitor Inbox Submissions')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
    <div>
        <p class="text-sm text-slate-500">Read and process contact requests submitted by visitors on the website.</p>
    </div>
</div>

<!-- Desktop Table View -->
<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden hidden md:block">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                    <th class="px-6 py-4">Sender Details</th>
                    <th class="px-6 py-4">Service Required</th>
                    <th class="px-6 py-4">Message Snippet</th>
                    <th class="px-6 py-4">Submitted Date</th>
                    <th class="px-6 py-4 text-center">Status</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm">
                @forelse($submissions as $sub)
                    <tr class="hover:bg-slate-50/50 transition-colors {{ $sub->status === 'new' ? 'bg-[#0f2343]/5 font-medium' : '' }}">
                        <td class="px-6 py-4">
                            <div class="font-bold text-slate-800">{{ $sub->name }}</div>
                            <div class="text-xs text-slate-400 mt-1 flex flex-col gap-0.5">
                                <span class="flex items-center gap-1"><i data-lucide="mail" class="w-3 h-3"></i>{{ $sub->email }}</span>
                                <span class="flex items-center gap-1"><i data-lucide="phone" class="w-3 h-3"></i>{{ $sub->phone }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-2.5 py-1 rounded bg-[#0f2343]/10 text-primary text-xs font-bold uppercase">
                                {{ $sub->service ?? 'General Inquiry' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 max-w-xs">
                            <div class="text-xs text-slate-400 line-clamp-2 mt-1">{{ $sub->message }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-xs text-slate-500">
                            {{ $sub->created_at->format('M d, Y h:i A') }}
                        </td>
                        <td class="px-6 py-4 text-center whitespace-nowrap">
                            @if($sub->status === 'new')
                                <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">New</span>
                            @else
                                <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-500">Read</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.contact.show', $sub) }}" class="p-2 text-slate-600 hover:text-primary hover:bg-slate-100 rounded-lg transition-colors" title="View Message">
                                    <i data-lucide="mail-open" class="w-4 h-4"></i>
                                </a>
                                <form action="{{ route('admin.contact.destroy', $sub) }}" method="POST" class="inline" onsubmit="confirmDelete(event, this)">
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
                                <i data-lucide="inbox" class="w-8 h-8 text-slate-300"></i>
                                <span>No message submissions found in your inbox.</span>
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
    @forelse($submissions as $sub)
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 {{ $sub->status === 'new' ? 'border-l-4 border-l-blue-500 bg-blue-50/10' : '' }}">
            <div class="flex items-start justify-between gap-3">
                <div class="min-w-0 flex-1">
                    <div class="flex items-center gap-2">
                        <span class="font-bold text-slate-800 text-sm">{{ $sub->name }}</span>
                        @if($sub->status === 'new')
                            <span class="inline-flex px-1.5 py-0.5 rounded-full text-[9px] font-semibold bg-blue-100 text-blue-800">New</span>
                        @endif
                    </div>
                    <div class="text-[11px] text-slate-400 mt-1 flex flex-col gap-0.5">
                        <span class="flex items-center gap-1"><i data-lucide="mail" class="w-3 h-3"></i>{{ $sub->email }}</span>
                        <span class="flex items-center gap-1"><i data-lucide="phone" class="w-3 h-3"></i>{{ $sub->phone }}</span>
                    </div>

                    <div class="mt-2.5">
                        <span class="inline-flex px-2 py-0.5 rounded bg-[#0f2343]/10 text-primary text-[10px] font-bold uppercase">
                            {{ $sub->service ?? 'General Inquiry' }}
                        </span>
                    </div>

                    <div class="text-xs text-slate-500 mt-2 line-clamp-2">{{ $sub->message }}</div>
                    
                    <div class="text-[10px] text-slate-400 mt-3 flex items-center gap-1">
                        <i data-lucide="clock" class="w-3.5 h-3.5"></i>
                        <span>{{ $sub->created_at->format('M d, Y h:i A') }}</span>
                    </div>
                </div>
                <div class="flex flex-col gap-1.5 flex-shrink-0">
                    <a href="{{ route('admin.contact.show', $sub) }}" class="p-2 text-slate-600 hover:text-primary hover:bg-slate-100 rounded-lg transition-colors">
                        <i data-lucide="mail-open" class="w-4 h-4"></i>
                    </a>
                    <form action="{{ route('admin.contact.destroy', $sub) }}" method="POST" onsubmit="confirmDelete(event, this)">
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
            <i data-lucide="inbox" class="w-8 h-8 mx-auto mb-2 text-slate-300"></i>
            <p class="text-sm">No message submissions found in your inbox.</p>
        </div>
    @endforelse
</div>
@endsection
