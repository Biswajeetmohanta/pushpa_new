@extends('admin.layouts.app')

@section('title', 'Manage Our Team')
@section('page-title', 'Company Team Members')

@section('content')
<div x-data="{ isWorkforceModalOpen: false }">
    <div class="mb-6 flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
        <div>
            <p class="text-sm text-slate-500">Add, edit, and organize executive and operation team members shown on the page.</p>
        </div>
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full lg:w-auto">
            <button @click="isWorkforceModalOpen = true" class="inline-flex items-center justify-center gap-2 bg-slate-100 hover:bg-slate-200 text-slate-700 hover:text-slate-800 font-semibold px-4 py-2.5 rounded-lg shadow-sm transition-all text-sm w-full sm:w-auto cursor-pointer">
                <svg class="w-4 h-4 text-accent" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                <span>Manage Workforce Stats</span>
            </button>
            <a href="{{ route('admin.team.create') }}" class="inline-flex items-center justify-center gap-2 bg-[#0f2343] hover:bg-primary text-white font-semibold px-4 py-2.5 rounded-lg shadow-sm hover:shadow-md transition-all text-sm w-full sm:w-auto">
                <i data-lucide="plus" class="w-4 h-4"></i>
                <span>Add Team Member</span>
            </a>
        </div>
    </div>

<!-- Desktop Table View -->
<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden hidden md:block">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                    <th class="px-6 py-4">Avatar</th>
                    <th class="px-6 py-4">Name</th>
                    <th class="px-6 py-4">Role</th>
                    <th class="px-6 py-4">Social Handles</th>
                    <th class="px-6 py-4 text-center">Status</th>
                    <th class="px-6 py-4 text-center">Order</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm">
                @forelse($members as $member)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($member->image)
                                <img src="{{ asset($member->image) }}" alt="{{ $member->name }}" class="w-12 h-12 object-cover rounded-full border border-slate-200">
                            @else
                                <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 border border-slate-200">
                                    <i data-lucide="user" class="w-5 h-5"></i>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="font-bold text-slate-800">{{ $member->name }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex px-2.5 py-1 rounded bg-[#0f2343]/5 text-[#0f2343] text-xs font-semibold uppercase max-w-[200px] break-words">
                                {{ $member->role }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex gap-2 text-slate-400">
                                @if($member->facebook)
                                    <a href="{{ $member->facebook }}" target="_blank" class="hover:text-[#0f2343]" title="Facebook">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                                    </a>
                                @endif
                                @if($member->twitter)
                                    <a href="{{ $member->twitter }}" target="_blank" class="hover:text-[#0f2343]" title="Twitter">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"/></svg>
                                    </a>
                                @endif
                                @if($member->linkedin)
                                    <a href="{{ $member->linkedin }}" target="_blank" class="hover:text-[#0f2343]" title="LinkedIn">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>
                                    </a>
                                @endif
                                @if($member->instagram)
                                    <a href="{{ $member->instagram }}" target="_blank" class="hover:text-[#0f2343]" title="Instagram">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                                    </a>
                                @endif
                                @if(!$member->facebook && !$member->twitter && !$member->linkedin && !$member->instagram)
                                    <span class="text-xs italic text-slate-400">None linked.</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center whitespace-nowrap">
                            @if($member->is_active)
                                <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">Active</span>
                            @else
                                <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-400">Hidden</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center whitespace-nowrap text-slate-500">{{ $member->sort_order }}</td>
                        <td class="px-6 py-4 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.team.edit', $member) }}" class="p-2 text-slate-600 hover:text-primary hover:bg-slate-100 rounded-lg transition-colors" title="Edit">
                                    <i data-lucide="edit-3" class="w-4 h-4"></i>
                                </a>
                                <form action="{{ route('admin.team.destroy', $member) }}" method="POST" class="inline" onsubmit="confirmDelete(event, this)">
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
                                <i data-lucide="users" class="w-8 h-8 text-slate-300"></i>
                                <span>No team members found. Create one to get started!</span>
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
    @forelse($members as $member)
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4">
            <div class="flex items-start gap-3">
                @if($member->image)
                    <img src="{{ asset($member->image) }}" alt="{{ $member->name }}" class="w-12 h-12 object-cover rounded-full border border-slate-200 flex-shrink-0">
                @else
                    <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 border border-slate-200 flex-shrink-0">
                        <i data-lucide="user" class="w-5 h-5"></i>
                    </div>
                @endif
                <div class="flex-1 min-w-0">
                    <div class="font-bold text-slate-800 text-sm truncate">{{ $member->name }}</div>
                    <div class="mt-1">
                        <span class="inline-flex px-2 py-0.5 rounded bg-[#0f2343]/5 text-[#0f2343] text-[10px] font-semibold uppercase">
                            {{ $member->role }}
                        </span>
                    </div>

                    <div class="flex gap-2 text-slate-400 mt-2.5">
                        @if($member->facebook)
                            <a href="{{ $member->facebook }}" target="_blank" class="hover:text-[#0f2343]" title="Facebook">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                            </a>
                        @endif
                        @if($member->twitter)
                            <a href="{{ $member->twitter }}" target="_blank" class="hover:text-[#0f2343]" title="Twitter">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"/></svg>
                            </a>
                        @endif
                        @if($member->linkedin)
                            <a href="{{ $member->linkedin }}" target="_blank" class="hover:text-[#0f2343]" title="LinkedIn">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>
                            </a>
                        @endif
                        @if($member->instagram)
                            <a href="{{ $member->instagram }}" target="_blank" class="hover:text-[#0f2343]" title="Instagram">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                            </a>
                        @endif
                    </div>

                    <div class="flex items-center gap-2 mt-3.5">
                        <span class="text-xs text-slate-400">Order: {{ $member->sort_order }}</span>
                        @if($member->is_active)
                            <span class="inline-flex px-2 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-100 text-emerald-800">Active</span>
                        @else
                            <span class="inline-flex px-2 py-0.5 rounded-full text-[10px] font-semibold bg-slate-100 text-slate-400">Hidden</span>
                        @endif
                    </div>
                </div>
                <div class="flex flex-col gap-1.5 flex-shrink-0">
                    <a href="{{ route('admin.team.edit', $member) }}" class="p-2 text-slate-600 hover:text-primary hover:bg-slate-100 rounded-lg transition-colors">
                        <i data-lucide="edit-3" class="w-4 h-4"></i>
                    </a>
                    <form action="{{ route('admin.team.destroy', $member) }}" method="POST" onsubmit="confirmDelete(event, this)">
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
        <div class="col-span-full bg-white rounded-xl shadow-sm border border-slate-200 p-8 text-center text-slate-400">
            <svg class="w-8 h-8 mx-auto mb-2 text-slate-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            <p class="text-sm">No team members found. Create one to get started!</p>
        </div>
    @endforelse
</div>

<!-- Skilled & Dedicated Workforce Modal -->
<div x-show="isWorkforceModalOpen" 
     x-cloak 
     class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 md:p-10"
     style="display: none;"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100">
    
    <!-- Dark glass overlay backdrop -->
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" @click="isWorkforceModalOpen = false"></div>
    
    <!-- Modal Box -->
    <div x-show="isWorkforceModalOpen" 
         x-transition:enter="transition ease-out duration-300 transform"
         x-transition:enter-start="opacity-0 scale-95 translate-y-4"
         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200 transform"
         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
         x-transition:leave-end="opacity-0 scale-95 translate-y-4"
          class="relative z-10 w-full max-w-4xl bg-white rounded-2xl shadow-2xl overflow-hidden flex flex-col max-h-[85vh] sm:max-h-[90vh]">
        
        <!-- Close Button -->
        <button @click="isWorkforceModalOpen = false" 
                class="absolute top-4 right-4 z-20 w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-700 hover:text-slate-900 flex items-center justify-center transition-colors shadow-sm cursor-pointer"
                aria-label="Close modal">
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </button>
        
        <!-- Modal Header -->
        <div class="bg-slate-50 border-b border-slate-200 px-6 py-5 flex items-center gap-3 flex-shrink-0">
            <div class="w-10 h-10 rounded-xl bg-[#0f2343]/5 flex items-center justify-center text-[#0f2343] flex-shrink-0">
                <svg class="w-5 h-5 text-accent" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
            <div>
                <h3 class="font-serif text-base sm:text-lg font-bold text-slate-800">Skilled & Dedicated Workforce Settings</h3>
                <p class="text-xs text-slate-500">Configure global statistics and counts shown in three columns on the Our Team page.</p>
            </div>
        </div>
        
        <!-- Modal Body (Scrollable form) -->
        <form action="{{ route('admin.team.workforce') }}" method="POST" class="flex flex-col flex-1 min-h-0 overflow-hidden">
            @csrf
            @method('PUT')

            <!-- Scrollable fields container -->
            <div class="flex-1 overflow-y-auto p-6 space-y-6 min-h-0">
                <div class="grid gap-4">
                    <!-- Title -->
                    <div>
                        <label for="workforce_title" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Section Title *</label>
                        <input type="text" name="workforce_title" id="workforce_title" required value="{{ old('workforce_title', $setting->workforce_title) }}"
                               class="block w-full px-4 py-3 rounded-lg border border-slate-200 bg-white focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all">
                    </div>

                    <!-- Subtitle -->
                    <div>
                        <label for="workforce_subtitle" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Section Description / Subtitle</label>
                        <textarea name="workforce_subtitle" id="workforce_subtitle" rows="3"
                                  class="block w-full px-4 py-3 rounded-lg border border-slate-200 bg-white focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all resize-none"
                                  placeholder="Write a short description explaining the workforce size and capability...">{{ old('workforce_subtitle', $setting->workforce_subtitle) }}</textarea>
                    </div>
                </div>

                <!-- Three Columns of Workforce -->
                <div class="grid md:grid-cols-3 gap-6">
                    <!-- Management & Engineering -->
                    <div class="p-4 bg-slate-50 rounded-xl border border-slate-150 space-y-3">
                        <label for="workforce_management" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Management & Engineering</label>
                        <textarea name="workforce_management" id="workforce_management" rows="8"
                                  class="block w-full px-3 py-2 rounded-lg border border-slate-200 bg-white focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all text-xs font-mono"
                                  placeholder="Label: Count (one per line)">{{ old('workforce_management', $setting->workforce_management) }}</textarea>
                        <span class="block text-[10px] text-slate-400">Enter as `Label: Count`, one per line (e.g. `Project Managers: 08`).</span>
                    </div>

                    <!-- Site Execution & Supervision -->
                    <div class="p-4 bg-slate-50 rounded-xl border border-slate-150 space-y-3">
                        <label for="workforce_execution" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Site Execution & Supervision</label>
                        <textarea name="workforce_execution" id="workforce_execution" rows="8"
                                  class="block w-full px-3 py-2 rounded-lg border border-slate-200 bg-white focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all text-xs font-mono"
                                  placeholder="Label: Count (one per line)">{{ old('workforce_execution', $setting->workforce_execution) }}</textarea>
                        <span class="block text-[10px] text-slate-400">Enter as `Label: Count`, one per line (e.g. `Foremen: 15`).</span>
                    </div>

                    <!-- Skilled & Unskilled Labour -->
                    <div class="p-4 bg-slate-50 rounded-xl border border-slate-150 space-y-3">
                        <label for="workforce_labour" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Skilled & Unskilled Labour</label>
                        <textarea name="workforce_labour" id="workforce_labour" rows="8"
                                  class="block w-full px-3 py-2 rounded-lg border border-slate-200 bg-white focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all text-xs font-mono"
                                  placeholder="Label: Count (one per line)">{{ old('workforce_labour', $setting->workforce_labour) }}</textarea>
                        <span class="block text-[10px] text-slate-400">Enter as `Label: Count`, one per line (e.g. `Skilled Labour: 1250`).</span>
                    </div>
                </div>
            </div>

            <!-- Submit Button / Actions as fixed footer -->
            <div class="flex items-center justify-between px-6 py-4 border-t border-slate-150 bg-slate-50 flex-shrink-0">
                <div class="text-[11px] text-slate-400">
                    Changes take effect instantly on the public team page.
                </div>
                <div class="flex items-center gap-3">
                    <button type="button" @click="isWorkforceModalOpen = false" 
                            class="px-5 py-2.5 rounded-lg border border-slate-200 hover:bg-slate-50 text-slate-700 font-semibold text-sm transition-colors cursor-pointer">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="inline-flex items-center gap-2 bg-[#0f2343] hover:bg-primary text-white font-semibold px-5 py-2.5 rounded-lg shadow-sm hover:shadow-md transition-all text-sm cursor-pointer">
                        <span>Save Changes</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
@endsection
