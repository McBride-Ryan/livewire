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
<body class="bg-gray-200">
    <h1 class="text-3xl font-bold underline">
        Hello from Livewire
    </h1>
    <livewire:counter />

    <h2 class="text-lg font-semibold">Just saying hi</h2>
<br><br>

    @livewire('life-cycle', ['name'=>'Ryan', 'adj' => 'awesome blossom'])

    @livewireScripts
</body>
</html>
