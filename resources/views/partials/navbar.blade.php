<nav
    class="block backdrop-saturate-200 backdrop-blur-2xl bg-opacity-80 border border-white/80 w-full max-w-full px-4 bg-white text-white rounded-xl transition-all sticky top-4 z-40 py-3 shadow-md shadow-blue-gray-500/5">
    <div class="flex justify-between gap-6 md:flex-row md:items-center">
        <div class="">
            <nav aria-label="breadcrumb" class="w-max">
                <ol
                    class="flex flex-wrap items-center w-full bg-opacity-60 rounded-md bg-transparent p-0 transition-all mt-1">
                    <li
                        class="flex items-center text-blue-gray-900 antialiased font-sans text-sm font-normal leading-normal cursor-pointer transition-colors duration-300 hover:text-light-blue-500">
                        <p class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-normal">
                            {{ Request::path('') == '/' ? 'Welcome' : '/' . Request::path('') }}
                        </p>
                    </li>
                </ol>
            </nav>
            <h6
                class="capitalize block antialiased tracking-normal font-sans text-base font-semibold leading-relaxed text-blue-gray-900">
                {{ Request::path('') == '/' ? 'Welcome' : Request::path('') }} Page
            </h6>
        </div>
        <div class="flex gap-1 items-center">
            <div class="mr-auto md:mr-4 md:w-56"></div>
            <button
                class="relative align-middle select-none font-sans font-medium text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none w-10 max-w-[40px] h-10 max-h-[40px] rounded-lg text-xs text-blue-gray-500 hover:bg-blue-gray-500/10 active:bg-blue-gray-500/30 grid xl:hidden"
                type="button" style="position: relative; overflow: hidden;" id="toggle-sidebar-hamburger">
                <span class="absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"
                        stroke-width="3" class="h-6 w-6 text-blue-gray-500">
                        <path fill-rule="evenodd"
                            d="M3 6.75A.75.75 0 013.75 6h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 6.75zM3 12a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75A.75.75 0 013 12zm0 5.25a.75.75 0 01.75-.75h16.5a.75.75 0 010 1.5H3.75a.75.75 0 01-.75-.75z"
                            clip-rule="evenodd"></path>
                    </svg>
                </span>
            </button>
            <form action="/logout" method="post">
                @csrf
                <button
                    class="align-middle select-none font-sans font-bold text-center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 rounded-lg text-blue-gray-500 hover:bg-blue-gray-500/10 active:bg-blue-gray-500/30 hidden items-center gap-1 px-4 xl:flex normal-case">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 512 512"
                        class="h-4 w-4 text-blue-gray-500">
                        <path
                            d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 32C43 32 0 75 0 128L0 384c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z" />
                    </svg>Logout
                </button>
                <button
                    class="relative align-middle select-none font-sans font-medium text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none w-10 max-w-[40px] h-10 max-h-[40px] rounded-lg text-xs text-blue-gray-500 hover:bg-blue-gray-500/10 active:bg-blue-gray-500/30 grid xl:hidden">
                    <span class="absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 512 512"
                            class="h-4 w-4 text-blue-gray-500">
                            <path
                                d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 32C43 32 0 75 0 128L0 384c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z" />
                        </svg>
                    </span>
                </button>
            </form>
        </div>
    </div>
</nav>
