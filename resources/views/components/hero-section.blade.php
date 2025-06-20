<section class="relative min-h-[40vh] md:min-h-[50vh] flex items-center justify-center">
    @if($image)
        <!-- Background Image -->
        <div class="absolute inset-0">
            <img src="{{ Storage::url('hero/' . $image) }}" alt="{{ $title }}"
                 class="w-full h-full object-cover">
            <!-- Dark Overlay -->
            <div class="absolute inset-0 bg-black/50"></div>
        </div>
    @else
        <!-- Fallback Background -->
        <div class="absolute inset-0 bg-gradient-to-br from-primary-600 to-primary-800"></div>
    @endif
    
    <!-- Content Overlay -->
    <div class="container mx-auto px-4 relative z-20 text-center">
        <div class="max-w-3xl mx-auto">
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">
                {{ $title }}
            </h1>
        </div>
    </div>
</section>
