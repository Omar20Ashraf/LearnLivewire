<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livewire</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />

    @vite('resources/css/app.css')
    @livewireStyles

</head>

<body class="flex flex-wrap justify-center">
    <div class="flex w-full justify-left px-4 bg-purple-900 text-white">
        <a class="mx-3 py-4" href="/">Home</a>
    </div>
    <div class="my-10 flex justify-center">
        <div class="w-10/12 my-10 flex">
            <div class="w-5/12 rounded border p-2">
                <livewire:tickets />
            </div>
            <div class="w-7/12 mx-2 rounded border p-2">
                <livewire:comments />
            </div>
        </div>
    </div>

    <livewire:scripts />
</body>

</html>
