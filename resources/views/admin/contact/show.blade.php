@extends('admin.layouts.app')

@section('title', 'View Message')
@section('page-title', 'Read Message Detail')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.contact.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-primary transition-colors">
        <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
        <span>Back to Inbox</span>
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden max-w-4xl">
    <div class="p-6 sm:p-8 space-y-6">
        
        <!-- Header area -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-slate-100 pb-6">
            <div>
                <h3 class="text-xl font-bold text-slate-800">{{ $submission->name }}</h3>
                <p class="text-xs text-slate-400 mt-1 flex items-center gap-1">
                    <i data-lucide="calendar" class="w-3.5 h-3.5"></i>
                    <span>Submitted on {{ $submission->created_at->format('M d, Y h:i A') }}</span>
                </p>
            </div>
            
            <div class="flex gap-2">
                <span class="inline-flex px-3 py-1 rounded bg-[#0f2343]/10 text-primary text-xs font-bold uppercase items-center gap-1.5">
                    <i data-lucide="compass" class="w-3.5 h-3.5"></i>
                    <span>{{ $submission->service ?? 'General Inquiry' }}</span>
                </span>
                
                <form action="{{ route('admin.contact.destroy', $submission) }}" method="POST" onsubmit="confirmDelete(event, this)">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center gap-1 bg-red-50 hover:bg-red-100 text-red-700 px-3 py-1.5 rounded-lg text-xs font-semibold shadow-sm transition-colors border border-red-200">
                        <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                        <span>Delete Message</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Sender info cards -->
        <div class="grid sm:grid-cols-2 gap-4">
            <div class="p-4 bg-slate-50 rounded-lg border border-slate-100 flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 border border-slate-200 flex-shrink-0">
                    <i data-lucide="mail" class="w-4 h-4"></i>
                </div>
                <div>
                    <div class="text-[10px] text-slate-400 uppercase font-semibold">Email Address</div>
                    <a href="mailto:{{ $submission->email }}" class="text-sm font-semibold text-[#0f2343] hover:underline">{{ $submission->email }}</a>
                </div>
            </div>

            <div class="p-4 bg-slate-50 rounded-lg border border-slate-100 flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 border border-slate-200 flex-shrink-0">
                    <i data-lucide="phone" class="w-4 h-4"></i>
                </div>
                <div>
                    <div class="text-[10px] text-slate-400 uppercase font-semibold">Phone Number</div>
                    <a href="tel:{{ $submission->phone }}" class="text-sm font-semibold text-[#0f2343] hover:underline">{{ $submission->phone }}</a>
                </div>
            </div>
        </div>

        <!-- Message Body -->
        <div class="space-y-2 pt-2">
            <h4 class="text-sm font-semibold text-slate-800">Message Content</h4>
            <div class="p-5 bg-slate-50/50 rounded-lg border border-slate-200/60 text-slate-700 text-sm leading-relaxed whitespace-pre-line shadow-inner">
                {{ $submission->message }}
            </div>
        </div>

        <!-- Action / Reply suggestion -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-5 flex items-start gap-4">
            <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center flex-shrink-0 border border-blue-200">
                <i data-lucide="message-square" class="w-5 h-5"></i>
            </div>
            <div class="space-y-1">
                <h5 class="text-sm font-semibold text-blue-800">Need to reply?</h5>
                <p class="text-xs text-blue-600/90 leading-normal">
                    You can quickly reach out to <strong>{{ $submission->name }}</strong> by clicking on their contact details above to send an email or make a direct phone call.
                </p>
            </div>
        </div>

    </div>
</div>
@endsection
