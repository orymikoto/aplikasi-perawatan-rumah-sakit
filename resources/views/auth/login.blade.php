<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Aplikasi Perawatan Rumah Sakit</title>
</head>

<body class="w-full h-screen">
  <main class="w-full h-full flex flex-col items-center bg-gradient-to-tr from-emerald-500 to-emerald-900">
    <h1 class="text-center my-8 font-comfortaa font-bold text-white text-2xl">SISTEM INFORMASI SENSUS HARIAN RAWAT INAP</h1>
    <div class="flex flex-col p-4 rounded-2xl items-center bg-white/25 gap-y-8">
      <div class="flex flex-col items-center gap-y-4">
        <img src="/logo.png" class="lg:w-32 lg:h-32 w-24 h-24" />
        <h2 class="font-comfortaa font-bold">RUMKIT Tk. III BALADHIKA HUSADA JEMBER</h2>
      </div>
      <div class="flex flex-col items-center gap-y-6 mb-8">
        <p class="font-jakarta-sans text-white">SILAHKAN LOGIN</p>
        <form action="" class="flex flex-col gap-y-4">
          <input type="text" placeholder="USERNAME"
            class=" w-[300px]  bg-white rounded-md placeholder:text-neutral-400 outline-none px-4 py-2 font-jakarta-sans text-neutral-800">
          <input type="password" placeholder="PASSWORD"
            class=" w-[300px]  bg-white rounded-md placeholder:text-neutral-400 outline-none px-4 py-2 font-jakarta-sans text-neutral-800">
          <button type="submit"
            class="bg-blue-800 text-white font-comfortaa mx-auto px-4 py-2 rounded-md hover:text-blue-700 hover:bg-white hover:shadow-lg hover:shadow-blue-700/50 duration-200">LOGIN</button>
        </form>
      </div>
    </div>
  </main>

</body>

</html>
