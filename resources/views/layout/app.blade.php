<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <nav class="bg-gray-800">
        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
            <div class="relative flex h-16 items-center justify-between">

                <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">

                </div>
                <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                    @guest()

                        <a class="text-white  px-3 py-2" href="/login">Login</a>
                        <a class="text-white  px-3 py-2" href="/registration">Register</a>
                    @else
                    <livewire:logout-page />
                    @endguest
                </div>
            </div>
        </div>

    </nav>
    {{-- <div class="div">
        <livewire:logout-page />
    </div> --}}
    <div>
        {{ $slot }}
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</html>
