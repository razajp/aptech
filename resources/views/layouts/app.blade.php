<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('tailwind.js') }}"></script>
    <script src="{{ asset('jquery.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>@yield('title', 'Aptech')</title>
    <style>
        :root {
            --bg-color: #fbfbfd;
            --h-bg-color:#f2f2f2;
            --secondary-bg-color: #ffffff;
            --h-secondary-bg-color: hsl(0, 0%, 96%);
            --text-color: #1f2937;
            --secondary-text: #4b5563;
            --bg-warning: hsl(45, 100%, 87%);
            --bg-success: hsl(130, 100%, 87%);
            --bg-error: hsl(360, 100%, 87%);
            --h-bg-warning: hsl(45, 100%, 80%);
            --h-bg-success: hsl(130, 100%, 80%);
            --h-bg-error: hsl(360, 100%, 80%);
            --border-warning: hsl(45, 100%, 45%);
            --border-success: hsl(130, 100%, 45%);
            --border-error: hsl(360, 100%, 45%);
            --text-warning: hsl(45, 75%, 40%);
            --text-success: hsl(130, 75%, 40%);
            --text-error: hsl(360, 75%, 40%);

            --danger-color: hsl(0, 65%, 51%);
            --h-danger-color: hsl(0, 65%, 41%);
            --success-color: hsl(142, 65%, 36%);
            --h-success-color: hsl(142, 65%, 26%);

            --overlay-color: rgba(0, 0, 0, 0.3);
        }
        
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
</head>

<body class="bg-[--bg-color] text-[--text-color] text-sm min-h-screen flex flex-col md:flex-row items-center justify-center fade-in" cz-shortcut-listen="true">
    {{-- side bar --}}
    @if (Auth::check())
        <script>
            const url = window.location.href; // Get the current URL
        </script>

        <x-sidebar>
        </x-sidebar>
    @endif

    <div class="wrapper flex-1 flex flex-col md:h-screen relative w-full">
        {{-- alert --}}
        <div id="messageBox" class="absolute top-5 mx-auto flex items-center flex-col space-y-3 z-50 text-sm w-full select-none pointer-events-none">
            @if (session('success'))
                <x-alert type="success" :messages="session('success')" />
            @endif
        
            @if (session('warning'))
                <x-alert type="warning" :messages="session('warning')" />
            @endif
        
            @if (session('error'))
                <x-alert type="error" :messages="session('error')" />
            @endif
        </div>
        
        {{-- main content --}}
        <main class="flex-1 px-8 py-0 md:p-8 overflow-y-auto my-scroller-2 flex items-center justify-center">
            <div class="main-child grow">
                @yield('content')
            </div>
        </main>
    </div>
</body>

</html>
