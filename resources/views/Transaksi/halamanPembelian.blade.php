<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Barang</title>
    <style>
        body {
            background-color: white;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            margin-top: -10%;
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
            margin-right: 90%;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            margin-left: 1em;
        }

        .content {
            padding-top: 80px; /* Mengimbangi posisi fixed header */
        }

        .img_thumbnail {
            width: 200px; /* Atur lebar gambar */
            height: 150px; /* Atur tinggi gambar */
            object-fit: cover;
            border-radius: 4px;
        }

        .search-form-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 5% 0;
        }

        .search-form input[type="text"],
        .search-form button {
            padding: 10px;
            font-size: large;
        }

        .search-form input[type="text"] {
            width: 300px; /* Adjust the width as needed */
            margin-bottom: 10px;
        }

        .search-form button {
            background-color: #FFA500;
            border: none;
            color: white;
            cursor: pointer;
            border-radius: 100%;
        }

        .search-form button:hover {
            background-color: #e59400;
        }

        .search-buttons {
            display: flex;
            justify-content: center;
            gap: 10px; /* Mengatur jarak antar tombol */
        }

        .search-buttons form {
            margin: 0;
        }

        .search-buttons button {
            margin: 0;
            padding: 10px;
            background-color: #FFA500;
            border: none;
            color: white;
            cursor: pointer;
            font-size: large;
            border-radius: 100%;
        }

        .search-buttons button:hover {
            background-color: #e59400;
        }

        .keranjang {
            position: fixed;
            top: 10%;
            right: 15px;
        }

        .keranjang a {
            color: #333;
            text-decoration: none;
        }

        .keranjang a:hover {
            color: #337ab7;
        }
        .home {
            position: fixed;
            top: 8%;
            left: 1%;
            color: white;
            background-color: #337ab7;
            padding: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        }
        .arrowleft {
            border: solid white;
            border-width: 0 3px 3px 0;
            display: inline-block;
            padding: 3px;
            transform: rotate(135deg);
            -webkit-transform: rotate(135deg);
        }
        a{border-bottom: none; text-decoration: none;}

        .user-dropdown {
        position: relative;
        display: inline-block;
    }

    .username {
        cursor: pointer;
        color: white; /* Warna teks */
        font-weight: bold;
    }

    .arrow-down {
        margin-left: 5px; /* Spasi antara nama dan panah */
        border: solid white;
        border-width: 0 2px 2px 0;
        display: inline-block;
        padding: 3px;
        transform: rotate(45deg);
        -webkit-transform: rotate(45deg);
    }

    .dropdown-content {
        display: none; /* Sembunyikan dropdown secara default */
        position: absolute;
        background-color: #f1f1f1;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {
        background-color: #ddd;
    }
    /* Tampilkan dropdown saat di-hover */

    .user-dropdown:hover .dropdown-content {
        display: block;
    }
    </style>
</head>
<body>
<header>
    <div>@ Amay Kantin</div>
    <nav>
    @if (Auth::check())
    <div class="user-dropdown">
        <span class="username">{{ Auth::user()->name }}
        <span class="arrow-down"></span> <!-- Panah ke bawah -->
        </span> <!-- Menampilkan nama pengguna -->
        <div class="dropdown-content">
            @if (Auth::user()->role == 'pembeli')
                <form id="logout-form-pembeli" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="#" onclick="event.preventDefault(); if (confirm('Apakah Anda yakin ingin logout?')) { document.getElementById('logout-form-pembeli').submit(); }">
                    Logout Pembeli
                </a>
            @else
                <form id="logout-form-user" action="{{ route('logoutUser') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="#" onclick="event.preventDefault(); if (confirm('Apakah Anda yakin ingin logout?')) { document.getElementById('logout-form-user').submit(); }">
                    Logout Admin
                </a>
            @endif
        </div>
    </div>
@else
    <a href="{{ route('HalamanLoginPembeli') }}">Login Pembeli</a>
@endif


    </nav>
</header>
@if (Auth::check())
@if (Auth::user()->role == 'admin') {{-- or any other condition to check for Pembeli --}}
<div class="home">
    <a href="{{ route('halamanUser') }}"><i class="arrowleft"></i></a>
</div>

@endif
@endif
<div class="keranjang">
    <a href="{{ route('HalamanKeranjang2') }}">
        <img src="{{ asset('gambar/keranjang.png') }}" alt="keranjang" width="50px">
    </a>
</div>

<div class="search-form-container">
    <form action="{{ route('search') }}" method="GET" class="search-form">
        <input type="text" name="search" placeholder="Cari Nama Barang">
        <button type="submit">Cari</button>
    </form>
    <div class="search-buttons">
        <form action="{{ route('search') }}" method="GET">
            <input type="hidden" name="search">
            <button type="submit" >Semua</button>
        </form>
        <a href="#makanan" class="search-buttons">
            <button type="button">Makanan</button>
        </a>
        <a href="#minuman" class="search-buttons">
            <button type="button">Minuman</button>
        </a>
    </div>
</div>

<div class="content">
    <div class="container">
        <h1>Kantin Amay</h1>

        <h2 style="text-align: center;" id="makanan">Makanan</h2>
        <div class="barang">
        @foreach($makanan as $barang)
        <div class="barang-item">
            <div class="barang-info">
                <img src="{{ asset('storage/images/' . $barang->image) }}" alt="{{ $barang->nama_barang }}" class="img_thumbnail">
                <div class="barang-details">
                    <p style="text-align: left;">Nama: {{ $barang->nama_barang }}</p>
                    <p style="text-align: left;">Harga: Rp.{{ $barang->harga_barang }}</p>
                    <p style="text-align: left;">Sisa: {{ $barang->jumlah_barang }}</p>
                    @if (Auth::check() && Auth::user()->role == 'pembeli')
                        <a href="{{ route('HalamanDefinisiBarang', ['id' => $barang->id]) }}">Beli</a>
                    @elseif (Auth::check() && Auth::user()->role == 'admin')
                        <a href="{{ route('HalamanDefinisiBarang', ['id' => $barang->id]) }}">Beli</a>
                    @else
                        <a href="{{ route('HalamanLoginPembeli') }}">Beli</a>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
        </div>

        <h2 style="text-align: center;" id="minuman">Minuman</h2>
        <div class="barang">
            @foreach($minuman as $barang)
                <div class="barang-item">
                    <form action="{{ route('HalamanDefinisiBarang', $barang->id) }}" method="GET">
                        <img src="{{ asset('storage/images/' . $barang->image) }}" alt="{{ $barang->nama_barang }}" class="img_thumbnail">
                        <div class="barang-info">
                            <p style="text-align: left;">Nama: {{ $barang->nama_barang }}</p>
                            <p style="text-align: left;">Harga: {{ $barang->harga_barang }}</p>
                            <p style="text-align: left;">Stock: {{ $barang->jumlah_barang }}</p>
                            @if (Auth::check() && Auth::user()->role == 'pembeli')
                            <a href="{{ route('HalamanDefinisiBarang', ['id' => $barang->id, 'user_id' => Auth::id()]) }}">Beli</a>
                            @elseif (Auth::check() && Auth::user()->role == 'admin')
                            <a href="{{ route('HalamanDefinisiBarang', ['id' => $barang->id]) }}">Beli</a>
                            @else
                            <a href="{{ route('HalamanLoginPembeli') }}">Beli</a>
                            @endif
                        </div>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="login-section">
    <div>
        <a href="{{ route('HalamanLoginPenjual') }}" style="color: white; text-decoration: none; font-size: xx-large; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); background-color: black; padding: 10px;">+</a>
    </div>
</div>

<footer>
    Hak Cipta &copy; Kantin Amay 2024.
</footer>
</body>


    <script>
    document.addEventListener('DOMContentLoaded', (event) => {
        document.querySelector('.username').addEventListener('click', function() {
            var dropdown = this.nextElementSibling;
            if (dropdown.style.display === "block") {
                dropdown.style.display = "none";
            } else {
                dropdown.style.display = "block";
            }
        });

        // Klik di luar dropdown untuk menutupnya
        window.onclick = function(event) {
            if (!event.target.matches('.username')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.style.display === "block") {
                        openDropdown.style.display = "none";
                    }
                }
            }
        }
    });
</script>



</html>
