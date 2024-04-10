<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Dashboard Aplikasi</title>
</head>

<body class="min-h-screen flex flex-col bg-neutral-50 p-4">
    <header>
        <div class="flex flex-col md:flex-row items-center gap-4 mb-8">
            <img src="/logo.png" alt="Logo Rumah Sakit" class="w-32">
            <div
                class="flex flex-col md:items-start font-josefin-sans items-center md:text-left text-center text-emerald-800 ">
                <p class="font-bold text-xl">SISTEM INFORMASI SENSUS HARIAN RAWAT INAP</p>
                <p class="font-semibold text-lg">RUMKIT TK. III BALADIKA HUSADA JEMBER</p>
            </div>
        </div>
    </header>

    <main class="flex gap-4 w-full">
        <x-sidebar />
        <div class="flex flex-col h-full min-h-[80vh] p-4 bg-white shadow-md rounded-[2rem] flex-1">

            @yield('content')
        </div>
    </main>
</body>

</html>
