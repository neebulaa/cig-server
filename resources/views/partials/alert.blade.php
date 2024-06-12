@php
    $alertClassTypes = [
        'danger' => 'bg-red-500',
        'success' => 'bg-green-500',
    ];
@endphp
<div role="alert"
    class="alert max-w-md relative mt-4 block w-full text-base font-regular px-4 py-4 rounded-lg {{ $alertClassTypes[$type] }} text-white flex"
    style="opacity: 1;">
    <div class="shrink-0">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
            aria-hidden="true" class="h-6 w-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z">
            </path>
        </svg>
    </div>
    <div class="ml-3 mr-12">{{ $message }}
    </div>
    <button
        class="close-alert relative align-middle select-none font-sans font-medium text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none w-8 max-w-[32px] h-8 max-h-[32px] rounded-lg text-xs text-white hover:bg-white/10 active:bg-white/30 !absolute top-3 right-3"
        type="button">
        <span class="absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                class="h-6 w-6" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </span>
    </button>
</div>

<script>
    const closeAlert = document.querySelector('.close-alert');
    const alert = document.querySelector('.alert');

    async function wait(ms) {
        return new Promise((resolve, reject) => {
            setTimeout(() => {
                resolve();
            }, ms);
        });
    }
    async function reduceOpacity(element) {
        let promise = new Promise(async (resolve, reject) => {
            let opacity = 1;
            let reduceRate = .05;

            while (opacity > 0) {
                opacity -= reduceRate;
                element.style.opacity = opacity;
                await wait(10);
            }
            resolve();
        });

        return promise;
    }

    setTimeout(async () => {
        if (alert) {
            await reduceOpacity(alert);
            alert.remove();
        }
    }, 5000);

    closeAlert.addEventListener('click', async function() {
        await reduceOpacity(alert);
        alert.remove();
    });
</script>
