<!DOCTYPE html>

<html>

<head>
    <meta viewport="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ config('app.name') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=alexandria:400,500,600,700|roboto:400,500,700" rel="stylesheet" />

    @vite(['resources/js/app.js', 'resources/css/app.css'])
    @filamentStyles
    <script>
        (function() {
            if (localStorage.getItem('theme') === 'dark' ||
                (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>
</head>

<body class="m-0 dark:bg-primary-full font-alexandria">
    <header>
        <x-navigation />
    </header>

    <main>
        {{ $slot }}
    </main>

    @livewire('notifications')
    @filamentScripts
</body>

</html>
