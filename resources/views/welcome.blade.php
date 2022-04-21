<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LiveWire Playground</title>
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @livewireStyles

</head>
<body>
    <h1 class="text-3xl font-bold underline">
        Hello from Livewire
    </h1>
    <livewire:counter />

    <h2 class="text-lg font-semibold">Standard Contact Form</h2>

    <livewire:validation-form />

    @livewireScripts
</body>
</html>
