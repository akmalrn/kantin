<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Barang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: white;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1000px;
            margin:  auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .barang {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .barang-item {
            width: 200px;
            margin: 10px;
            text-align: center;
        }

        .barang-item img {
            max-width: 100%;
            border-radius: 4px;
        }

        .barang-info {
            padding: 10px;
            background-color: #f4f4f4;
            border-radius: 4px;
        }

        footer {
            background-color: #FFA500;
            padding: 5px;
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
        }
        header {

            background-color: #FFA500;
            padding: 5px;
            top: 0;
            width: 100%;
            text-align: center;
            position: fixed;
            z-index: 1000;
        }

        .login-section {
            position: fixed;
            right: 1em;
            bottom: 3em;
            text-align: right;
        }

        .login-section div {
            margin-top: 0.5em;
        }

        nav {
            display: flex;
            justify-content: flex-end;
            margin-right: 20px;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            margin-left: 1em;
        }

        .content {
            padding-top: 80px; /* Mengimbangi posisi fixed header */
        }
        .barang-info {
            display: none; /* Deskripsi makanan awalnya disembunyikan */
        }
        .img_thumbnail {
            width: 100%;
            max-height: 100%;
             /* Tinggi gambar akan disesuaikan agar proporsi tetap */
}
.search-form {
    position: absolute;
    top: 0px; /* Distance from the top */
    left: 0%; /* Move to the middle of the page */
    transform: translateX(-80%); /* Center align */
    display: flex;
    align-items: center;
    width: 100%; /* Adjust the width as needed */
}

.search-form input[type="text"] {
    flex: 1;
    padding: 10px;
    margin-right: 10px; /* Space between input and button */
    width: 100%;
    box-sizing: border-box; /* Ensure padding doesn't affect width */
}

        .keranjang {
            position: fixed;
            top: 20%;
            right: 10px;
        }

        .keranjang a {
            color: #333;
            text-decoration: none;
        }

        .keranjang a:hover {
            color: #337ab7;
        }
    </style>
</head>
<body>
<script>
    function toggleDeskripsi(image) {
        var barangInfo = image.nextElementSibling; // Dapatkan elemen sibling berikutnya (deskripsi makanan)
        if (barangInfo.style.display === "none") {
            barangInfo.style.display = "block"; // Tampilkan deskripsi jika sebelumnya disembunyikan
        } else {
            barangInfo.style.display = "none"; // Sembunyikan deskripsi jika sebelumnya ditampilkan
        }
    }
</script>

<header>


    <div>@ Amay Kantin</div>
    <nav>
        <a href="{{ route('HalamanLoginPembeli') }}">Login Pembeli</a>
    </nav>
</header>

<div class="keranjang">
    <a href="{{ route('HalamanKeranjang') }}">
    Keranjang
    </a>
</div>

<form action="{{ route('search') }}" method="GET" class="search-form" style="margin: 5% 80% 0px ;">
    <input type="text" name="search" placeholder="Cari Nama Produk">
    <button type="submit" style="background-color:#FFA500; font-size:x-large">Cari</button></form>
<div class="content">
    <div class="container">
        <h1>Kantin Amay</h1>
        <div class="barang">
            @foreach($barangs as $barang)
            <div class="barang-item">
                <img src="{{ asset('storage/images/' . $barang->image) }}" alt="{{ $barang->nama_barang }}" class="img_thumbnail" onclick="toggleDeskripsi(this)">
                <div class="barang-info">
                <p>Nama: {{ $barang->nama_barang }}</p>
                <p>ID Pemasok: {{ $barang->id_penjual }}</p>
                <p style="color: red;">Harga: Rp {{ number_format($barang->harga_barang, 0, ',', '.') }}</p>
                    <p>Jumlah: {{ $barang->jumlah_barang }}</p>
                    <form action="{{ route('TambahKeKeranjang') }}" method="POST">
    @csrf
</div>
<div>
<p>Nama: {{ $barang->nama_barang }}</p>
<label for="jumlah_barang">Jumlah Barang:</label>
</div>

    <input type="hidden" name="id" value="{{ $barang->id }}"> <!-- ID Barang Tersembunyi -->
    <input type="number" name="jumlah_barang" id="jumlah_barang">
    <button type="submit">Tambah ke Keranjang</button>
</form>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="login-section">
    <div>
        <a href="{{ route('HalamanLoginPenjual') }}" style="color: white; text-decoration: none; font-size:xx-large; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);background-color: black; padding:10px;">+</a>
    </div>
</div>
<footer>
    Hak Cipta &copy; Kantin Amay 2024.


</footer>
</body>
</html>