<div x-data="{ open: @entangle('openUploadModal') }" x-cloak
    x-init="$watch('open', value => { if(value) $nextTick(() => $refs.focusInput.focus()) })"
    wire:keydown.enter="deleteProject" @keyup.escape.window="open = false">

    <div x-show="open" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-400"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black/30 flex items-center justify-center z-50 p-4">

        <div @click.outside="$wire.set('openUploadModal', false)" x-show="open"
            x-transition:enter="transition ease-out duration-200 transform"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150 transform"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
            class="bg-white rounded-lg w-full max-w-2xl dark:bg-gray-800 flex flex-col max-h-[90vh]">

            <!-- Scrollable Content -->
            <div class="overflow-y-auto flex-1 p-6">
                <div x-data="{
                    files: [],
                    isDragging: false,
                    uploadProgress: 0,

                    init() {
                        this.$watch('$wire.openUploadModal', value => {
                            if (value) {
                                this.files = [];
                                this.uploadProgress = 0;
                            }
                        });
                    },

                    addFiles(newFiles) {
                        Array.from(newFiles).forEach(file => {
                            this.files.push({
                                id: crypto.randomUUID(),
                                name: file.name,
                                size: file.size,
                                progress: 0,
                                uploading: true,
                                completed: false,
                            });
                        });
                    },

                    formatFileSize(bytes) {
                        const k = 1024;
                        const sizes = ['Bytes','KB','MB','GB'];
                        const i = Math.floor(Math.log(bytes) / Math.log(k));
                        return (bytes / Math.pow(k, i)).toFixed(2) + ' ' + sizes[i];
                    }
                }" x-on:livewire-upload-start="
                    uploadProgress = 0;
                    files.forEach(f => {
                        f.uploading = true;
                        f.completed = false;
                        f.progress = 0;
                    });
                " x-on:livewire-upload-progress="
                    uploadProgress = $event.detail.progress;

                    // distribute progress visually
                    files.forEach(f => {
                        if (!f.completed) {
                            f.progress = uploadProgress;
                        }
                    });
                " x-on:livewire-upload-finish="
                    uploadProgress = 100;
                    files.forEach(f => {
                        f.progress = 100;
                        f.uploading = false;
                        f.completed = true;
                    });
                " x-on:livewire-upload-error="
                    files.forEach(f => f.uploading = false);
                    " @dragover.prevent="isDragging = true" @dragleave.prevent="isDragging = false" @drop.prevent="isDragging = false; 
                    addFiles($event.dataTransfer.files)">

                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h3 class="text-xl font-bold text-slate-800 dark:text-slate-200">Upload Your Files</h3>
                            <p class="text-slate-600 dark:text-slate-400 text-sm mt-1">Choose files or drag and drop
                                them here</p>
                        </div>
                        <div x-show="files.length > 0" class="text-right">
                            <p class="text-xl font-bold text-blue-600"
                                x-text="files.filter(f => f.completed).length + '/' + files.length"></p>
                            <p class="text-xs text-slate-600 dark:text-slate-400">Files uploaded</p>
                        </div>
                    </div>

                    <div :class="isDragging ? 'border-blue-500 bg-blue-50 dark:bg-blue-900/20 scale-[1.02]' : 'border-slate-300 dark:border-gray-600 bg-white dark:bg-gray-700 hover:border-slate-400'"
                        class="relative border-2 border-dashed rounded-xl p-6 transition-all duration-300">

                        <input type="file" wire:model="files" multiple @change="addFiles($event.target.files)"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" id="file-upload">

                        <div class="flex flex-col items-center justify-center py-8">
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center mb-4 shadow-lg shadow-blue-500/30">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-slate-800 dark:text-slate-200 mb-2">Choose files or
                                drag & drop</h3>
                            <p class="text-slate-500 dark:text-slate-400 text-sm mb-3">Support for PDF, DOC, DOCX, JPG,
                                PNG up to 10MB per file</p>
                            <label for="file-upload"
                                class="px-5 py-2.5 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors cursor-pointer shadow-lg shadow-blue-500/30">
                                Browse Files
                            </label>
                        </div>
                    </div>

                    @if ($errors->any())
                    <div
                        class="mt-4 p-3 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg">
                        <div class="flex items-start gap-2">
                            <svg class="w-5 h-5 text-red-600 dark:text-red-400 flex-shrink-0 mt-0.5" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-red-800 dark:text-red-300 mb-2">Please fix the
                                    following errors:</p>
                                <ul class="list-disc list-inside space-y-1">
                                    @foreach ($errors->all() as $error)
                                    <li class="text-sm text-red-700 dark:text-red-400">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Uploading Indicator -->
                    <div x-show="files.some(f => f.uploading)"
                        class="mt-4 p-3 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg">
                        <div class="flex items-center gap-2">
                            <div
                                class="w-4 h-4 border-2 border-blue-600 border-t-transparent rounded-full animate-spin">
                            </div>
                            <span class="text-sm text-blue-800 dark:text-blue-300 font-medium"
                                x-text="'Uploading ' + files.filter(f => f.uploading).length + ' file(s)...'"></span>
                        </div>
                    </div>

                    <!-- Files List - Scrollable -->
                    <div x-show="files.length > 0" class="mt-4">
                        <h3 class="text-base font-semibold text-slate-800 dark:text-slate-200 mb-3"
                            x-text="'Uploaded Files (' + files.length + ')'"></h3>

                        <div class="space-y-2 max-h-64 overflow-y-auto pr-2">
                            <template x-for="file in files" :key="file.id">
                                <div
                                    class="bg-slate-50 dark:bg-gray-700 rounded-lg p-3 shadow-sm border border-slate-200 dark:border-gray-600">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center flex-shrink-0">
                                            <svg x-show="file.completed" class="w-5 h-5 text-green-600" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <svg x-show="!file.completed" class="w-5 h-5 text-blue-600" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="font-medium text-slate-800 dark:text-slate-200 truncate text-sm"
                                                x-text="file.name"></p>
                                            <div class="flex items-center gap-2 mt-0.5">
                                                <p class="text-xs text-slate-500 dark:text-slate-400"
                                                    x-text="formatFileSize(file.size)"></p>
                                                <template x-if="file.uploading">
                                                    <span>
                                                        <span class="text-slate-400">•</span>
                                                        <span class="text-xs text-slate-500 dark:text-slate-400 ml-1"
                                                            x-text="file.progress + '%'"></span>
                                                    </span>
                                                </template>
                                                <template x-if="file.completed">
                                                    <span>
                                                        <span class="text-slate-400">•</span>
                                                        <span
                                                            class="text-xs text-green-600 font-medium ml-1">Complete</span>
                                                    </span>
                                                </template>
                                            </div>
                                        </div>
                                    </div>

                                    <div x-show="file.uploading" class="mt-2">
                                        <div
                                            class="w-full bg-slate-200 dark:bg-gray-600 rounded-full h-1.5 overflow-hidden">
                                            <div class="h-full bg-gradient-to-r from-blue-500 to-blue-600 rounded-full transition-all duration-300 ease-out"
                                                :style="'width: ' + file.progress + '%'"></div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                    <div class="mt-4 flex items-center gap-2 text-xs text-slate-500 dark:text-slate-400">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                            </path>
                        </svg>
                        <span>Your files are secure and encrypted</span>
                    </div>
                </div>
            </div>

            <!-- Footer - Fixed -->
            <div class="p-6 border-t border-gray-200 dark:border-gray-700 flex justify-end space-x-2">
                <x-buttons.button action="$set('openUploadModal', false)" type="outline" label="Cancel" />
                <x-buttons.button action="uploadFile" type="primary" loading="Upload" />

                {{-- <button 
                    wire:click="uploadFile"
                    wire:target="uploadFile" 
                    wire:loading.attr="disabled" 
                    class="border rounded-md bg-blue-500 px-3 py-2 text-white hover:bg-blue-600 transition duration-200 shadow-md disabled:opacity-50 disabled:cursor-not-allowed">
                    
                    <span wire:loading.remove wire:target="uploadFile">
                        Upload Files
                    </span>
                    <span wire:loading wire:target="uploadFile">
                        <span class="fa fa-spinner animate-spin"></span> Uploading files...
                    </span>

                </button> --}}

            </div>

        </div>
    </div>
</div>