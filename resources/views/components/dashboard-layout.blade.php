<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite('resources/css/app.css')
  @vite('resources/js/app.js')
  <title>Dashboard Aplikasi</title>

  {{-- <link href = "https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel = "stylesheet" /> --}}

  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script> --}}
  {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
</head>

<body class="min-h-screen bg-neutral-50 p-4 overflow-x-auto relative max-w-[1920px] mx-auto ">
  <header>
    <div class="flex flex-col md:flex-row items-center gap-4 mb-8">
      <img src="/logo.png" alt="Logo Rumah Sakit" class="w-32">
      <div class="flex flex-col md:items-start font-josefin-sans items-center md:text-left text-center text-emerald-800 ">
        <p class="font-bold text-xl">SISTEM INFORMASI SENSUS HARIAN RAWAT INAP</p>
        <p class="font-semibold text-lg">RUMKIT TK. III BALADIKA HUSADA JEMBER</p>
      </div>

    </div>
    @include('flash::message')
  </header>

  <main class="flex gap-4 overflow-x-clip relative">
    <x-sidebar />
    <div class="flex flex-col h-full min-h-[80vh] p-8 bg-white shadow-md rounded-[2rem] w-[80%] max-w-[75%]">
      @yield('content')
    </div>
  </main>
</body>

</html>
