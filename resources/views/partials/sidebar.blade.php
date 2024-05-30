@php
    $routes = [
        [
            'text' => 'Dashboard',
            'slug' => 'dashboard',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
            aria-hidden="true" class="w-5 h-5 text-inherit">
            <path
            d="M11.47 3.84a.75.75 0 011.06 0l8.69 8.69a.75.75 0 101.06-1.06l-8.689-8.69a2.25 2.25 0 00-3.182 0l-8.69 8.69a.75.75 0 001.061 1.06l8.69-8.69z">
            </path>
            <path
            d="M12 5.432l8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 01-.75-.75v-4.5a.75.75 0 00-.75-.75h-3a.75.75 0 00-.75.75V21a.75.75 0 01-.75.75H5.625a1.875 1.875 0 01-1.875-1.875v-6.198a2.29 2.29 0 00.091-.086L12 5.43z">
            </path>
            </svg>',
            'path' => '/',
            'active' => Request::is('/'),
        ],
        [
            'text' => 'Users',
            'slug' => 'users',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
            aria-hidden="true" class="w-5 h-5 text-inherit">
            <path fill-rule="evenodd"
            d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"
            clip-rule="evenodd"></path>
            </svg>',
            'path' => '/users',
            'active' => Request::is('users*'),
        ],
        [
            'text' => 'Page Content',
            'slug' => 'page-content',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
            aria-hidden="true" class="w-5 h-5 text-inherit">
            <path fill-rule="evenodd"
            d="M1.5 5.625c0-1.036.84-1.875 1.875-1.875h17.25c1.035 0 1.875.84 1.875 1.875v12.75c0 1.035-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 011.5 18.375V5.625zM21 9.375A.375.375 0 0020.625 9h-7.5a.375.375 0 00-.375.375v1.5c0 .207.168.375.375.375h7.5a.375.375 0 00.375-.375v-1.5zm0 3.75a.375.375 0 00-.375-.375h-7.5a.375.375 0 00-.375.375v1.5c0 .207.168.375.375.375h7.5a.375.375 0 00.375-.375v-1.5zm0 3.75a.375.375 0 00-.375-.375h-7.5a.375.375 0 00-.375.375v1.5c0 .207.168.375.375.375h7.5a.375.375 0 00.375-.375v-1.5zM10.875 18.75a.375.375 0 00.375-.375v-1.5a.375.375 0 00-.375-.375h-7.5a.375.375 0 00-.375.375v1.5c0 .207.168.375.375.375h7.5zM3.375 15h7.5a.375.375 0 00.375-.375v-1.5a.375.375 0 00-.375-.375h-7.5a.375.375 0 00-.375.375v1.5c0 .207.168.375.375.375zm0-3.75h7.5a.375.375 0 00.375-.375v-1.5A.375.375 0 0010.875 9h-7.5A.375.375 0 003 9.375v1.5c0 .207.168.375.375.375z"
            clip-rule="evenodd"></path>
            </svg>',
            'path' => '/page-content',
            'active' => Request::is('page-content*'),
        ],
        [
            'text' => 'Products',
            'slug' => 'products',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
            class="w-5 h-5 text-inherit" fill="currentColor">
            <path
            d="M160 112c0-35.3 28.7-64 64-64s64 28.7 64 64v48H160V112zm-48 48H48c-26.5 0-48 21.5-48 48V416c0 53 43 96 96 96H352c53 0 96-43 96-96V208c0-26.5-21.5-48-48-48H336V112C336 50.1 285.9 0 224 0S112 50.1 112 112v48zm24 48a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm152 24a24 24 0 1 1 48 0 24 24 0 1 1 -48 0z" />
            </svg>',
            'path' => '/products',
            'active' => false,
            'active' => Request::is('products*'),
        ],
        [
            'text' => 'Comodities',
            'slug' => 'comodities',
            'icon' =>
                '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="w-5 h-5 text-inherit" fill="currentColor"><path d="M264.5 5.2c14.9-6.9 32.1-6.9 47 0l218.6 101c8.5 3.9 13.9 12.4 13.9 21.8s-5.4 17.9-13.9 21.8l-218.6 101c-14.9 6.9-32.1 6.9-47 0L45.9 149.8C37.4 145.8 32 137.3 32 128s5.4-17.9 13.9-21.8L264.5 5.2zM476.9 209.6l53.2 24.6c8.5 3.9 13.9 12.4 13.9 21.8s-5.4 17.9-13.9 21.8l-218.6 101c-14.9 6.9-32.1 6.9-47 0L45.9 277.8C37.4 273.8 32 265.3 32 256s5.4-17.9 13.9-21.8l53.2-24.6 152 70.2c23.4 10.8 50.4 10.8 73.8 0l152-70.2zm-152 198.2l152-70.2 53.2 24.6c8.5 3.9 13.9 12.4 13.9 21.8s-5.4 17.9-13.9 21.8l-218.6 101c-14.9 6.9-32.1 6.9-47 0L45.9 405.8C37.4 401.8 32 393.3 32 384s5.4-17.9 13.9-21.8l53.2-24.6 152 70.2c23.4 10.8 50.4 10.8 73.8 0z"/></svg>',
            'path' => '/comodities',
            'active' => false,
            'active' => Request::is('comodities*'),
        ],
    ];

    function getActiveStateClassOfRoute($active)
    {
        if ($active) {
            return 'bg-gradient-to-tr from-gray-900 to-gray-800 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 active:opacity-[0.85]';
        }
        return 'text-blue-gray-500 hover:bg-blue-gray-500/10 active:bg-blue-gray-500/30';
    }
@endphp

<aside
    class="bg-white shadow-sm -translate-x-80 fixed inset-0 z-50 my-4 ml-4 h-[calc(100vh-32px)] w-72 rounded-xl transition-transform duration-300 xl:translate-x-0 border border-blue-gray-100"
    id="sidebar">
    <div class="relative">
        <a class="py-6 px-8 block" href="/">
            <h6
                class="block antialiased tracking-normal font-sans text-base font-semibold leading-relaxed text-blue-gray-900">
                CIG BACKOFFICE</h6>
        </a>
        <button
            class="align-middle select-none font-sans font-medium text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none w-8 max-w-[32px] h-8 max-h-[32px] rounded-lg text-xs text-white hover:bg-white/10 active:bg-white/30 absolute right-0 top-0 grid rounded-br-none rounded-tl-none xl:hidden"
            type="button">
            <span class="absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                    stroke="currentColor" aria-hidden="true" class="h-5 w-5 text-white">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </span>
        </button>
    </div>
    <div class="m-4">
        <ul class="mb-4 flex flex-col gap-1">
            @foreach ($routes as $route)
                <li>
                    <a href="{{ $route['path'] }}">
                        <button
                            class="align-middle select-none font-sans font-bold text-center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 rounded-lg {{ getActiveStateClassOfRoute($route['active']) }} w-full flex items-center gap-4 px-4 capitalize"
                            type="button">
                            {!! $route['icon'] !!}
                            <p
                                class="block antialiased font-sans text-base leading-relaxed text-inherit font-medium capitalize">
                                {{ $route['text'] }}
                            </p>
                        </button>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</aside>
