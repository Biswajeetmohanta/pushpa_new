@extends('admin.layouts.app')

@section('title', 'Edit Project')
@section('page-title', 'Modify Project')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.projects.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-primary transition-colors">
        <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
        <span>Back to Projects list</span>
    </a>
</div>

@if($errors->any())
    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-lg text-red-700 text-sm">
        <div class="flex items-center gap-2 mb-1">
            <i data-lucide="alert-circle" class="w-4 h-4 text-red-500"></i>
            <span class="font-semibold">Validation Errors</span>
        </div>
        <ul class="list-disc pl-5 mt-1 space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden max-w-4xl">
    <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8 space-y-6">
        @csrf
        @method('PUT')
        
        <div class="grid md:grid-cols-2 gap-6">
            <!-- Project Title -->
            <div>
                <label for="title" class="block text-sm font-semibold text-slate-700 mb-2">Project Title *</label>
                <input type="text" name="title" id="title" required value="{{ old('title', $project->title) }}"
                       class="block w-full px-4 py-3 rounded-lg border border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all"
                       placeholder="e.g. Botad Bypass Roadway">
            </div>

            <!-- Location -->
            <div>
                <label for="location" class="block text-sm font-semibold text-slate-700 mb-2">Location *</label>
                <input type="text" name="location" id="location" required value="{{ old('location', $project->location) }}"
                       class="block w-full px-4 py-3 rounded-lg border border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all"
                       placeholder="e.g. Botad, Gujarat">
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <!-- Sector Selection -->
            <div x-data="{ 
                newSectorName: '', 
                modalOpen: false, 
                errorMsg: '', 
                successMsg: '',
                loading: false,
                submitNewSector() {
                    if (!this.newSectorName.trim()) {
                        this.errorMsg = 'Please enter a valid sector name.';
                        return;
                    }
                    this.loading = true;
                    this.errorMsg = '';
                    this.successMsg = '';
                    
                    fetch('{{ route('admin.sectors.store') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            name: this.newSectorName,
                            sort_order: 0,
                            is_active: 1
                        })
                    })
                    .then(response => {
                        this.loading = false;
                        if (!response.ok) {
                            return response.json().then(err => { throw err; });
                        }
                        return response.json();
                    })
                    .then(data => {
                        this.successMsg = 'Sector created successfully!';
                        
                        // Append to select dropdown and select it
                        const selectEl = document.getElementById('sector');
                        const option = document.createElement('option');
                        option.value = this.newSectorName;
                        option.text = this.newSectorName;
                        option.selected = true;
                        selectEl.appendChild(option);
                        
                        this.newSectorName = '';
                        setTimeout(() => {
                            this.modalOpen = false;
                            this.successMsg = '';
                        }, 1000);
                    })
                    .catch(err => {
                        this.loading = false;
                        this.errorMsg = err.message || (err.errors && err.errors.name ? err.errors.name[0] : 'Failed to create sector.');
                    });
                }
            }">
                <div class="flex justify-between items-center mb-2">
                    <label for="sector" class="block text-sm font-semibold text-slate-700">Sector *</label>
                    <button type="button" @click="modalOpen = true" class="text-xs font-semibold text-accent hover:text-[#b4922f] inline-flex items-center gap-1">
                        <i data-lucide="plus-circle" class="w-3.5 h-3.5"></i>
                        <span>Add New Sector</span>
                    </button>
                </div>
                
                <select name="sector" id="sector" required
                        class="block w-full px-4 py-3 rounded-lg border border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all bg-white">
                    <option value="">Select a Sector</option>
                    @foreach($sectors as $sec)
                        <option value="{{ $sec }}" {{ old('sector', $project->sector) == $sec ? 'selected' : '' }}>{{ $sec }}</option>
                    @endforeach
                </select>

                <!-- Beautiful Inline Dynamic Modal for Quick Add Sector -->
                <div x-show="modalOpen" 
                     x-cloak 
                     class="fixed inset-0 z-50 flex items-center justify-center p-4"
                     style="display: none;">
                    
                    <!-- Glass Backdrop -->
                    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs" @click="modalOpen = false"></div>
                    
                    <!-- Modal Box -->
                    <div class="relative z-10 w-full max-w-md bg-white rounded-xl shadow-2xl overflow-hidden p-6 border border-slate-100" @click.away="modalOpen = false">
                        <h4 class="font-serif font-bold text-lg text-[#0f2343] mb-2 flex items-center gap-2">
                            <i data-lucide="folder-open" class="w-5 h-5 text-accent"></i>
                            <span>Create New Sector</span>
                        </h4>
                        <p class="text-xs text-slate-500 mb-4 font-sans">Add a new dynamic sector option instantly without leaving this page.</p>

                        <!-- Input field -->
                        <div class="space-y-3">
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 font-sans">Sector Name</label>
                            <input type="text" x-model="newSectorName" @keydown.enter.prevent="submitNewSector()"
                                   class="block w-full px-4 py-2.5 rounded-lg border border-slate-200 outline-none focus:border-accent focus:ring-2 focus:ring-accent/20 text-sm font-sans"
                                   placeholder="e.g. Special Bridges, Water Management">
                            
                            <!-- Error/Success States -->
                            <div x-show="errorMsg" x-cloak class="p-2 bg-red-50 text-red-700 text-xs rounded border border-red-150 font-sans" x-text="errorMsg"></div>
                            <div x-show="successMsg" x-cloak class="p-2 bg-emerald-50 text-emerald-800 text-xs rounded border border-emerald-150 font-sans" x-text="successMsg"></div>
                        </div>

                        <!-- Modal Actions -->
                        <div class="flex items-center justify-between gap-3 mt-6 pt-4 border-t border-slate-100">
                            <!-- Link to Full Manage -->
                            <a href="{{ route('admin.sectors.index') }}" target="_blank" class="text-xs font-semibold text-slate-400 hover:text-accent flex items-center gap-1 font-sans">
                                <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                                <span>Advanced Manager</span>
                            </a>
                            <div class="flex items-center gap-2">
                                <button type="button" @click="modalOpen = false" class="px-4 py-2 rounded-lg border border-slate-200 text-slate-600 font-semibold hover:bg-slate-50 text-xs transition-colors font-sans font-sans">
                                    Cancel
                                </button>
                                <button type="button" @click="submitNewSector()" :disabled="loading"
                                        class="px-4 py-2 rounded-lg bg-[#0f2343] hover:bg-primary text-white font-semibold text-xs flex items-center gap-1.5 shadow-sm hover:shadow-md transition-colors disabled:opacity-50 font-sans font-sans">
                                    <span x-show="!loading">Add Sector</span>
                                    <span x-show="loading" class="animate-spin rounded-full h-3 w-3 border-2 border-white border-t-transparent"></span>
                                    <span x-show="loading">Adding...</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sort Order -->
            <div>
                <label for="sort_order" class="block text-sm font-semibold text-slate-700 mb-2">Sort Order</label>
                <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $project->sort_order) }}"
                       class="block w-full px-4 py-3 rounded-lg border border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all"
                       placeholder="e.g. 0">
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <!-- Client Name -->
            <div>
                <label for="client" class="block text-sm font-semibold text-slate-700 mb-2">Client Name</label>
                <input type="text" name="client" id="client" value="{{ old('client', $project->client) }}"
                       class="block w-full px-4 py-3 rounded-lg border border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all"
                       placeholder="e.g. P. Chhotalal">
            </div>

            <!-- Project Value -->
            <div>
                <label for="value" class="block text-sm font-semibold text-slate-700 mb-2">Project Value</label>
                <input type="text" name="value" id="value" value="{{ old('value', $project->value) }}"
                       class="block w-full px-4 py-3 rounded-lg border border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all"
                       placeholder="e.g. 14.00 Cr">
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <!-- Timeline -->
            <div>
                <label for="timeline" class="block text-sm font-semibold text-slate-700 mb-2">Timeline</label>
                <input type="text" name="timeline" id="timeline" value="{{ old('timeline', $project->timeline) }}"
                       class="block w-full px-4 py-3 rounded-lg border border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all"
                       placeholder="e.g. 18 Months">
            </div>
        </div>

        <!-- Project Image -->
        <div x-data="{ preview: '{{ $project->image ?? '' }}' }">
            <label class="block text-sm font-semibold text-slate-700 mb-2">Project Image</label>
            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-300 border-dashed rounded-lg hover:border-accent transition-all cursor-pointer relative"
                 @click="$refs.fileInput.click()">
                <div class="space-y-1 text-center" x-show="!preview">
                    <i data-lucide="image-plus" class="mx-auto h-12 w-12 text-slate-400"></i>
                    <div class="flex text-sm text-slate-600 justify-center">
                        <span class="relative rounded-md font-medium text-accent hover:text-[#b4922f] focus-within:outline-none">Upload a file</span>
                    </div>
                    <p class="text-xs text-slate-400">PNG, JPG, JPEG, WEBP up to 5MB</p>
                </div>
                <!-- Thumbnail Preview -->
                <div class="w-full h-48 relative" x-show="preview" x-cloak>
                    <img :src="preview" class="w-full h-full object-cover rounded-lg">
                    <button type="button" @click.stop="preview = ''; $refs.fileInput.value = ''"
                            class="absolute top-2 right-2 p-1.5 bg-red-500 text-white rounded-full hover:bg-red-600 shadow-md">
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </button>
                </div>
                <input type="file" ref="fileInput" name="image" class="hidden" 
                       @change="let file = $event.target.files[0]; if(file) { let reader = new FileReader(); reader.onload = (e) => { preview = e.target.result; }; reader.readAsDataURL(file); }">
            </div>
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-sm font-semibold text-slate-700 mb-2">Project Description</label>
            <textarea name="description" id="description" rows="4"
                      class="block w-full px-4 py-3 rounded-lg border border-slate-200 focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition-all resize-none"
                      placeholder="Enter specific details about the project scope, duration, or outcomes...">{{ old('description', $project->description) }}</textarea>
        </div>

        <!-- Active Checkbox -->
        <div class="flex items-center pt-2">
            <label class="flex items-center gap-3 cursor-pointer select-none">
                <input type="checkbox" name="is_active" value="1" {{ $project->is_active ? 'checked' : '' }}
                       class="w-5 h-5 rounded border-slate-300 text-accent focus:ring-accent">
                <div>
                    <span class="block text-sm font-semibold text-slate-800">Publish Project</span>
                    <span class="block text-xs text-slate-400">Make this project visible on the home page gallery.</span>
                </div>
            </label>
        </div>

        <!-- Submit actions -->
        <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
            <a href="{{ route('admin.projects.index') }}" 
               class="px-5 py-2.5 rounded-lg border border-slate-200 hover:bg-slate-50 transition-all font-semibold text-slate-600 text-sm">
                Cancel
            </a>
            <button type="submit" 
                    class="px-5 py-2.5 rounded-lg bg-[#0f2343] hover:bg-primary text-white font-semibold shadow-sm hover:shadow-md transition-all text-sm">
                Update Project
            </button>
        </div>
    </form>
</div>
@endsection
