<?php

use App\Models\Advertisement;
use function Livewire\Volt\{state, mount, computed};

state(['showPopup' => false, 'advertisement' => null, 'hasAd' => false]);

mount(function () {
    // Get advertisement directly
    $ad = Advertisement::active()->first();
    
    if ($ad && $ad->is_active && $ad->image) {
        $this->hasAd = true;
        $this->advertisement = $ad->toArray();
        
        // Check if user has seen the popup in this session
        if (!session()->has('popup_shown')) {
            $this->showPopup = true;
            session(['popup_shown' => true]);
        }
    } else {
        $this->hasAd = false;
    }
});

$closePopup = function () {
    $this->showPopup = false;
};

?>

<div>

    
    <!-- Popup Modal -->
    <div 
        x-data="{ show: @entangle('showPopup') }"
        x-show="show"
        x-transition.opacity.duration.300ms
        @keydown.escape.window="show = false"
        class="fixed inset-0 z-[999] flex items-center justify-center bg-black/50 backdrop-blur-sm p-4"
        style="position: fixed !important; z-index: 9999 !important;"
    >
        <div 
            x-show="show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            @click.away="show = false"
            class="relative bg-white rounded-2xl shadow-2xl max-w-2xl w-full mx-4 overflow-hidden"
        >
            <!-- Close Button -->
            <button 
                wire:click="closePopup"
                class="absolute top-4 right-4 z-10 w-8 h-8 bg-white/90 hover:bg-white rounded-full flex items-center justify-center text-gray-600 hover:text-gray-800 transition-all duration-200 shadow-lg"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            @if($advertisement && $advertisement['image'])
                <!-- Advertisement Image -->
                <div class="relative">
                    <img 
                        src="{{ Storage::url($advertisement['image']) }}" 
                        alt="Advertisement" 
                        class="w-full h-auto max-h-[80vh] object-contain rounded-2xl"
                    >
                </div>
            @endif

            <!-- Bottom Accent -->
            <div class="h-1 bg-gradient-to-r from-primary-400 to-primary-600"></div>
        </div>
    </div>
</div>