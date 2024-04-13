<?php
$pesan = '';
$key = '';
$hasil = '';
if (isset($_POST['enkripsi'])) {
  $pesan = $_POST['pesan'];
  $key = $_POST['key'];
  // Proses enkripsi
  for ($i=0; $i < strlen($pesan); $i++) {
    $char = $pesan[$i];
    if (ctype_alpha($char)) {
      // Menentukan rentang ASCII yang sesuai berdasarkan huruf besar atau kecil
      $start = ord(ctype_upper($char) ? 'A' : 'a');
      $hasil .= chr(($start + ((ord($char) - $start + $key) % 26)));
    } else {
      // Tambahkan karakter yang tidak perlu dienkripsi
      $hasil .= $char;
    }
  }
} else if (isset($_POST['dekripsi'])) {
  $pesan = $_POST['pesan'];
  $key = $_POST['key'];
  // Proses dekripsi
  for ($i=0; $i < strlen($pesan); $i++) {
    $char = $pesan[$i];
    if (ctype_alpha($char)) {
      // Menentukan rentang ASCII yang sesuai berdasarkan huruf besar atau kecil
      $start = ord(ctype_upper($char) ? 'A' : 'a');
      $ascii = (ord($char) - $start - $key) % 26;
      // Pengecekan apakah ascii bernilai positif atau negatif
      if ($ascii <= -1 && $ascii >= -25) {
        $hasil .= chr($start + ($ascii + 26));
      } else {
        $hasil .= chr($start + $ascii);
      }
    } else {
      // Tambahkan karakter yang tidak perlu didekripsi
      $hasil .= $char;
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              dark: "#1e293b",
              primary: "#FF6E14",
            },
            fontFamily: {
              inter: ["Inter, sans-serif"],
            },
          },
        },
      };
    </script>
    <style type="text/tailwindcss">
      @import url("https://fonts.googleapis.com/css2?family=Inter:wght@200;400;700&display=swap");
      body {
        font-family: Inter, sans-serif;
      }
    </style>
    <title>Kriptografi - Caesar Cipher</title>
  </head>
  <body class="bg-[url('img/background.jpg')] bg-cover bg-center">
    <div class="flex justify-center items-center w-full h-20 bg-transparent backdrop-blur-md shadow-xl fixed top-0 z-10">
      <h1 class="my-auto text-dark text-4xl font-bold italic"><span class="text-primary">ENKRIPSI</span> PESAN</h1>
    </div>
    
    <div class="container mx-auto my-36 flex justify-center items-center flex-wrap W-1/2">
      <div
        class="w-full lg:w-1/2 md:w-4/5 mx-4 bg-slate-100 px-10 pt-10 rounded-xl shadow-2xl"
      >
        <div>
          <img
            src="img/lock-logo.png"
            alt="lock-logo"
            class="w-36 h-24 mx-auto mt-6 object-cover scale-90"
          />
          <h1 class="text-3xl font-bold text-dark text-center">
            Caesar Cipher
          </h1>
          <p
            class="text-base font-extralight text-dark text-center mt-3 mb-10 opacity-80"
          >
            Lindungi pesan anda dengan enkripsi Caesar Cipher!
          </p>
        </div>
        <form action="" method="post">
          <!-- Input -->
          <div class="mb-5">
            <label
              for="pesan"
              class="w-full block text-xl font-semibold text-dark mb-2"
              >Pesan</label
            >
            <textarea
              name="pesan"
              id="pesan"
              class="w-full h-32 text-lg bg-slate-200 p-3 text-dark resize-none rounded-md focus:outline-primary"
              placeholder="Masukan Pesan..."
              required
            ></textarea>
          </div>
          <div class="mb-8">
            <label
              for="key"
              class="w-full block text-xl font-semibold text-dark mb-2"
              >Kunci</label
            >
            <input
              type="number"
              min="0"
              name="key"
              id="key"
              class="w-full text-lg bg-slate-200 p-3 text-dark rounded-md focus:outline-primary"
              placeholder="Contoh: 3"
              required
            />
          </div>
          <div class="mb-10 flex justify-center gap-3">
            <button
              type="submit"
              name="enkripsi"
              value="enkripsi"
              class="px-3 py-2 bg-primary text-lg text-white font-medium rounded-md hover:bg-opacity-80"
            >
              Enkripsi
            </button>
            <button
              type="submit"
              name="dekripsi"
              value="dekripsi"
              class="px-3 py-2 bg-primary text-lg text-white font-medium rounded-md hover:bg-opacity-80"
            >
              Dekripsi
            </button>
          </div>
          <hr class="mb-6 border-2 border-slate-300" />
          <!-- Hasil -->
          <div class="flex flex-wrap justify-between mb-5">
            <div class="inline-block w-full sm:w-3/4 mb-5">
              <h6 class="w-full block text-xl font-semibold text-dark mb-2">
                Teks Sebelumnya
              </h6>
              <textarea class="w-full text-lg h-14 bg-slate-200 p-3 text-dark rounded-md resize-none" readonly><?= $pesan;?></textarea>
            </div>
            
            <div class="inline-block w-1/5">
              <h6 class="w-full block text-xl font-semibold text-dark mb-2">
                Kunci
              </h6>
              <textarea class="w-full text-lg h-14 bg-slate-200 p-3 text-dark rounded-md resize-none" readonly><?= $key;?></textarea>
            </div>
          </div>

          <div class="mb-5">
            <h6 class="w-full block text-xl font-semibold text-dark mb-2">
              Hasil
            </h6>
            <textarea class="w-full text-lg h-32 bg-slate-200 p-3 text-dark rounded-md resize-none" readonly><?= $hasil;?></textarea>

          </div>
          <div class="mt-14 mb-8">
            <p class="text-center text-lg font-semibold text-dark">
              &copy; 2024. Fajar Nurdiansyah
            </p>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
