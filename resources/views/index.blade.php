<x-layout>
    @section('body')
        <main class="my-10">
            <div class="container">
                <!-- Swiper Section -->
                <div class="w-full mb-10">
                    <div class="swiper mySwiper rounded-lg overflow-hidden shadow-lg">
                        <div class="swiper-wrapper">
                            @foreach ($postCarousel as $post)
                                <!-- Swiper Slide for Each Post -->
                                <li class="swiper-slide">
                                    <x-postcard :post="$post" class="lg:h-72" />
                                </li>
                            @endforeach
                        </div>
                        <!-- Swiper Pagination -->
                        <div class="swiper-pagination"></div>
                    </div>
                </div>

                <!-- Latest News Header and Main Content -->
                <div class="flex items-center mb-8">
                    <h2 class="text-xl font-bold text-gray-800 mr-4 tracking-wide">Latest News</h2>
                    <div class="flex-grow border-t border-gray-300"></div>
                </div>

                <!-- Post Section -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($posts as $post)
                        <div
                            class="relative transform transition-transform hover:scale-105 hover:shadow-lg rounded-lg overflow-hidden">
                            <x-postcard :post="$post" />
                        </div>
                    @endforeach
                </div>

                <!-- Pagination Links -->
                <div class="mt-8">
                    {{ $posts->links() }}
                </div>
            </div>
        </main>
    @endsection
</x-layout>
