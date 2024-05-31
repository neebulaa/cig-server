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
            'path' => '',
            'active' => Request::is('page-content*'),
            'children' => [
                [
                    'text' => 'Main Page',
                    'slug' => 'main-page',
                    'icon' =>
                        '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-4 h-4 text-inherit" fill="currentColor"><path d="M498.1 5.6c10.1 7 15.4 19.1 13.5 31.2l-64 416c-1.5 9.7-7.4 18.2-16 23s-18.9 5.4-28 1.6L284 427.7l-68.5 74.1c-8.9 9.7-22.9 12.9-35.2 8.1S160 493.2 160 480V396.4c0-4 1.5-7.8 4.2-10.7L331.8 202.8c5.8-6.3 5.6-16-.4-22s-15.7-6.4-22-.7L106 360.8 17.7 316.6C7.1 311.3 .3 300.7 0 288.9s5.9-22.8 16.1-28.7l448-256c10.7-6.1 23.9-5.5 34 1.4z"/></svg>',
                    'path' => '/page-content/main',
                    'active' => Request::is('page-content/main'),
                ],
                [
                    'text' => 'Products Page',
                    'slug' => 'products-page',
                    'icon' =>
                        '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-4 h-4 text-inherit" fill="currentColor"><path d="M160 265.2c0 8.5-3.4 16.6-9.4 22.6l-26.8 26.8c-12.3 12.3-32.5 11.4-49.4 7.2C69.8 320.6 65 320 60 320c-33.1 0-60 26.9-60 60s26.9 60 60 60c6.3 0 12 5.7 12 12c0 33.1 26.9 60 60 60s60-26.9 60-60c0-5-.6-9.8-1.8-14.5c-4.2-16.9-5.2-37.1 7.2-49.4l26.8-26.8c6-6 14.1-9.4 22.6-9.4H336c6.3 0 12.4-.3 18.5-1c11.9-1.2 16.4-15.5 10.8-26c-8.5-15.8-13.3-33.8-13.3-53c0-61.9 50.1-112 112-112c8 0 15.7 .8 23.2 2.4c11.7 2.5 24.1-5.9 22-17.6C494.5 62.5 422.5 0 336 0C238.8 0 160 78.8 160 176v89.2z"/></svg>',
                    'path' => '/page-content/products',
                    'active' => Request::is('page-content/products'),
                ],
                [
                    'text' => 'Articles Page',
                    'slug' => 'articles-page',
                    'icon' =>
                        '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-4 h-4 text-inherit" fill="currentColor"><path d="M96 0C43 0 0 43 0 96V416c0 53 43 96 96 96H384h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V384c17.7 0 32-14.3 32-32V32c0-17.7-14.3-32-32-32H384 96zm0 384H352v64H96c-17.7 0-32-14.3-32-32s14.3-32 32-32zm32-240c0-8.8 7.2-16 16-16H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16zm16 48H336c8.8 0 16 7.2 16 16s-7.2 16-16 16H144c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/></svg>',
                    'path' => '/page-content/articles',
                    'active' => Request::is('page-content/articles'),
                ],
            ],
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
                    @if (isset($route['children']))
                        <button
                            class="sidebar-toggler-dropdown align-middle select-none font-sans font-bold text-center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 rounded-lg {{ $route['active'] ? 'text-blue-gray-500 bg-blue-gray-300/20' : 'text-blue-gray-500 hover:bg-blue-gray-500/10 active:bg-blue-gray-500/30' }} w-full flex items-center gap-4 px-4 capitalize"
                            type="button">
                            {!! $route['icon'] !!}
                            <p
                                class="block antialiased font-sans text-base leading-relaxed text-inherit font-medium capitalize">
                                {{ $route['text'] }}
                            </p>

                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                class="ml-auto w-4 h-4 text-inherit" fill="currentColor">
                                <path
                                    d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z" />
                            </svg>
                        </button>

                        <div
                            class="dropdown overflow-y-hidden h-0 {{ $route['active'] ? 'h-[150px]' : '' }} transition-h duration-500">
                            @foreach ($route['children'] as $childrenRoute)
                                <a href="{{ $childrenRoute['path'] }}">
                                    <button
                                        class="align-middle select-none font-sans font-bold text-center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 rounded-lg {{ getActiveStateClassOfRoute($childrenRoute['active']) }} hover:bg-blue-gray-500/10 active:bg-blue-gray-500/30 w-full flex items-center gap-4 px-4 capitalize"
                                        type="button">
                                        <div class="ml-4"></div>
                                        {!! $childrenRoute['icon'] !!}
                                        <p
                                            class="block antialiased font-sans text-base leading-relaxed text-inherit font-medium capitalize">
                                            {{ $childrenRoute['text'] }}
                                        </p>
                                    </button>
                                </a>
                            @endforeach
                        </div>
                    @else
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
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</aside>

<script>
    const sidebarTogglerDropdown = document.querySelectorAll('.sidebar-toggler-dropdown');
    sidebarTogglerDropdown.forEach(toggler => {
        toggler.addEventListener('click', function() {
            const dropdown = toggler.nextElementSibling;
            dropdown.classList.toggle('open');
            if (dropdown.classList.contains('open')) {
                dropdown.classList.add('h-[150px]');
            }

            if (!dropdown.classList.contains('open')) {
                dropdown.classList.remove('h-[150px]');
            }
        });
    });
</script>
