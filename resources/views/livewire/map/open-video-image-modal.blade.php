<div x-data="{ 
        open: @entangle('openModal'), 
        currentIndex: @entangle('currentIndex'),
        show: true
    }" x-cloak @keyup.escape.window="open = false" @keyup.arrow-left.window="open && $wire.previousImage()"
    @keyup.arrow-right.window="open && $wire.nextImage()"
    x-init="$watch('currentIndex', () => { show = false; setTimeout(() => show = true, 50) })">

    <!-- Only show modal when open is true -->
    <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-50">

        <!-- Backdrop -->
        <div class="absolute inset-0 bg-black opacity-90"></div>
        0
        <!-- Main Container -->
        <div class="relative h-full w-full"> 

            <!-- Close Button -->
            <button @click="$wire.closeModal()" type="button"
                class="absolute top-4 right-4 text-white hover:text-gray-300 transition bg-black bg-opacity-50 rounded-full p-2 hover:bg-opacity-75 z-10">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Video/Image Display Area with Transition -->
           <div class="absolute inset-0 flex items-center justify-center px-28 py-4">
                <div x-show="show" x-transition:enter="transition ease-out duration-300 transform"
                    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                    class="flex items-center justify-center max-h-full max-w-full">

                    @if($fileMimes == 'image/png' || $fileMimes == 'image/jpeg' || $fileMimes == 'image/jpg')
                    <img src="{{$fileUrl}}"
                        class="max-h-[85vh] max-w-full object-contain rounded-lg shadow-2xl">
                    @endif

                    @if($fileMimes == 'video/mp4')
                        <video src="{{$fileUrl}}" controls autoplay loop></video>
                    @endif

                </div>
            </div>   

        </div>
    </div>
</div>