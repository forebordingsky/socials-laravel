<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Socials</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <x-header/>
    <div class="container mx-auto text-gray-600" id="app">
        {{ $slot }}
    </div>
    <script src="{{ mix('js/app.js') }}" defer></script>
</body>
</html>
