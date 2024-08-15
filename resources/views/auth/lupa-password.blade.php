<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite('resources/css/app.css')
  <title>Lupa Password</title>
</head>



<body class="min-h-screen">
  <main class="w-full min-h-screen h- flex flex-col items-center lg:justify-center justify-start  bg-gradient-to-tr from-emerald-800 to-emerald-600 ">
    <h1 class="text-3xl text-center font-extrabold font-josefin-sans text-white lg:my-12 my-8">SISTEM INFORMASI
      SENSUS
      HARIAN
      RAWAT INAP
    </h1>
    {{-- @if (session()->has('failed'))
      <x-alert.error title="Failed" :message="session()->get('failed')" @endsession" />
    @endif --}}
    <div class="md:w-[450px] w-[95vw] bg-white/40 items-center rounded-3xl overflow-hidden flex flex-col gap-4 px-4 py-2 mb-8">
      <img src="/logo.png" alt="Logo Rumah Sakit" class="w-32">
      <h2 class="font-josefin-sans font-bold text-center text-lg">RUMKIT TK. III BALADHIKA HUSADA JEMBER</h2>
      <form action="{{ route('lupa_password_post') }}" class="my-8 w-full flex flex-col gap-4 items-center " action="" method="POST">
        @csrf
        <x-input-text title='Email' name="email" placeholder="EMAIL" type='email' class='w-full' value="" />
        <x-flash::message />
        <x-button.submit-button title="Ajukan Reset Password" class="w-[200px]" />
        <a href="/login" class="text-sm font-semibold text-white hover:text-blue-600 duration-200">Kembali ke login</a>

      </form>
    </div>
  </main>
</body>

</html>
