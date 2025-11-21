<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Standalone Page' }}</title>
    @livewireStyles

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fluxAppearance
</head>

<body class="bg-white">
    <div class="w-full">
        {{ $slot }}
    </div>

    @livewireScripts
</body>

</html>