<a href="#" class="block transform transition">
    <div
        class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300 relative {{ $class }}">
        <img src="{{ Storage::url($post->thumbnail) }}" alt="thumbnail" class="w-full h-auto object-cover hover:scale-105">

        <!-- Gradient Overlay -->
        <div class="absolute inset-x-0 bottom-0 h-1/3 bg-gradient-to-t from-black to-transparent"></div>

        <!-- Text Overlay -->
        <div class="absolute inset-x-0 bottom-0 p-4 text-white z-10 flex flex-col justify-end">
            <h3 class="text-xl font-semibold truncate">{{ $post->title }}</h3>
            <p class="text-xs font-light truncate mt-2">{{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}
            </p>
        </div>
    </div>
</a>
