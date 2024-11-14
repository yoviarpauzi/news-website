<div class="container pt-24">
    <nav>
        <ul class="flex gap-x-5 overflow-x-auto scrollbar-hide lg:gap-x-16">
            <li>
                <a href="/" class="whitespace-nowrap {{ request()->is('/') ? 'underline' : '' }}">All</a>
            </li>
            @foreach ($categories as $category)
                <li>
                    <a href="/categories/{{ $category['id'] }}" class="whitespace-nowrap">{{ $category['name'] }}</a>
                </li>
            @endforeach
        </ul>
    </nav>
</div>
