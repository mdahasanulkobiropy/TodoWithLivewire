<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <Style>
        .button:hover {
            border: 2px solid #1751D0;


        }

        .color:hover {
            color: #1751D0
        }

        .hidden {
            display: none;
        }
    </Style>

</head>

<body>
    @guest()
    <nav class="bg-gray-800">
        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
            <div class="relative flex h-16 items-center justify-between">
                <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                </div>
                <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                    <a class="text-white  px-3 py-2" href="/login">Login</a>
                    <a class="text-white  px-3 py-2" href="/registration">Register</a>
                </div>
            </div>
        </div>
    </nav>
    @endguest
    <div>
        {{$slot}}
    </div>

</body>

</html>
