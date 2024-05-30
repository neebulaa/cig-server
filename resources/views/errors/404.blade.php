<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PT CIG | Back office</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="relative min-h-screen w-full flex items-center">
        <section class="m-8 flex gap-4 xl:gap-16 2xl:gap-32 xl:flex-row flex-col w-full justify-center items-center">
            <div class="w-full max-w-[500px] order-1 xl:-order-1">
                <div class="text-center">
                    <h2
                        class="block antialiased tracking-normal font-sans text-4xl leading-[1.3] text-inherit font-bold mb-1">
                        Not Found 404</h2>
                    <p class="block antialiased font-sans text-blue-gray-900 font-normal">We can't found your
                        destination. Please go back to the <a href="/" class="text-blue-gray-500">home page</a>
                    </p>
                </div>
                @yield('content')
            </div>
            <img src="/images/image-login-{{ random_int(1, 4) }}.jpg"
                class="w-full max-w-[500px] xl:max-w-full max-h-[150px] xl:w-2/5 xl:max-h-[90vh] xl:block overflow-hidden object-cover rounded-3xl">
        </section>
    </div>
</body>

</html>
