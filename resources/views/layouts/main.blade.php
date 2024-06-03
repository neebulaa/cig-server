<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PT CIG | Back office</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @include('partials.toast')
    @if (Request::is('login') || Request::is('register'))
        <div class="relative min-h-screen w-full flex items-center">
            <section class="m-8 flex xl:gap-16 2xl:gap-32 w-full justify-center items-center">
                <div class="w-full max-w-[500px]">
                    <div class="text-center">
                        <h2
                            class="block antialiased tracking-normal font-sans text-4xl leading-[1.3] text-inherit font-bold mb-1">
                            Sign In</h2>
                        <p class="block antialiased font-sans text-blue-gray-900 font-normal">Enter your username and
                            password to Sign In.</p>
                    </div>
                    @yield('content')
                </div>
                <img src="/images/image-login-{{ random_int(1, 4) }}.jpg"
                    class="w-2/5 max-h-[90vh] hidden xl:block overflow-hidden object-cover rounded-3xl">
            </section>
        </div>
    @else
        <div class="min-h-screen bg-blue-gray-50/50">
            @include('partials.sidebar')
            <div class="p-4 xl:ml-80">
                @include('partials.navbar')

                <div class="mx-auto my-5 px-2">
                    @yield('content')
                </div>
            </div>
        </div>
    @endif
    <script>
        const toggleSidebarButton = document.querySelector('#toggle-sidebar-hamburger');
        const sidebar = document.querySelector('#sidebar');

        toggleSidebarButton.addEventListener('click', function() {
            if (sidebar.classList.contains('-translate-x-80')) {
                sidebar.classList.add('translate-x-0')
                sidebar.classList.remove('-translate-x-80')
            } else {
                sidebar.classList.add('-translate-x-80')
                sidebar.classList.remove('translate-x-0')
            }
        });

        function getJsonFromFormData(formData) {
            const object = {};
            for (let data of formData) {
                const items = formData.getAll(data[0]);
                object[data[0]] = items.length == 1 ? items[0] : items;
            }
            return object;
        }

        async function fetching(method, url, options = {}) {
            const headers = {
                "Content-Type": 'application/json'
            }

            options.headers = {
                ...headers,
                ...options.headers
            };

            const response = await fetch(url, {
                method,
                ...options
            });
            const data = await response.json();
            return {
                status: response.status,
                data
            }
        }

        function createErrorMessagesElement(errors) {
            let container = '<div class="input-errors text-red-500">';
            for (let error in errors) {
                for (let message of errors[error]) {
                    const p = `<p class="mt-1">${message}</p>`;
                    container += p;
                }
            }
            container += '</div>'
            return container;
        }

        function setFormInputErrors(state = 'on', form, inputs, errors = []) {
            if (state == 'on') {
                form.classList.add('border-red-500');
                inputs.forEach((input, i) => {
                    if (Object.keys(errors).includes(input.name)) {
                        input.classList.add('border-red-500');
                        const errorMessagesElement = form.querySelector(
                            `input[name='${input.name}'] + .input-errors`);
                        if (errorMessagesElement) errorMessagesElement.remove();
                        input.insertAdjacentHTML("afterend", createErrorMessagesElement(errors));
                    }
                })
            } else if (state == 'off') {
                form.classList.remove('border-red-500');
                inputs.forEach(input => {
                    input.classList.remove('border-red-500');
                    const errorMessagesElement = form.querySelector(
                        `input[name='${input.name}'] + .input-errors`);
                    if (errorMessagesElement) errorMessagesElement.remove();
                })
            }
        }
    </script>
</body>

</html>
