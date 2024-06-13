<!DOCTYPE html>
<html>
<head>
    <title>Definisi Barang</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: white;
            text-align: center;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .img_thumbnail {
            width: 50%;
            max-height: 400px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .nama-barang {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .barang-info {
            text-align: left;
            margin-bottom: 20px;
        }

        .barang-info p {
            margin: 5px 0;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="number"] {
            width: 100%;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
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

        .notification {
            display: none;
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            position: fixed;
            top: 10px;
            width: 100%;
            text-align: center;
            z-index: 1000;
        }

        .error {
            background-color: #f44336;
        }

        .keranjang {
            position: fixed;
            top: 10%;
            right: 10px;
        }

        .keranjang a {
            color: #333;
            text-decoration: none;
        }

        .keranjang a:hover {
            color: #337ab7;
        }

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $('form.tambah-ke-keranjang').on('submit', function(e){
                e.preventDefault();

                var form = $(this);
                var formData = form.serialize();

                $.ajax({
                    url: form.attr('action'),
                    method: form.attr('method'),
                    data: formData,
                    success: function(response){
                        $('.notification').text(response.success).removeClass('error').fadeIn().delay(3000).fadeOut();
                    },
                    error: function(response){
                        $('.notification').text('Terjadi kesalahan, silahkan coba lagi.').addClass('error').fadeIn().delay(3000).fadeOut();
                    }
                });
            });
        });
    </script>
</head>
<body>
<div class="home">
    <a href="{{ route('Pembelian') }}"><i class="arrowleft"></i></a>
</div>
<div class="keranjang">
    <a href="{{ route('HalamanKeranjang2') }}">
    <img src="{{ asset('gambar/keranjang.png') }}"alt="keranjang" width="50px">
    </a>
</div>
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

<div class="notification"></div>

<div class="container">
    <img src="{{ asset('storage/images/' . $barang->image) }}" alt="{{ $barang->nama_barang }}" class="img_thumbnail">
    <div class="barang-info">
        <p>ID Pemasok :{{ $barang->id_penjual}}</p>
        <p class="nama-barang">Nama: {{ $barang->nama_barang }}</p>
        <p>Harga: Rp.{{ $barang->harga_barang }}</p>
        <p>Sisa: {{ $barang->jumlah_barang }}</p>
    </div>
    <form action="{{ route('TambahKeKeranjang') }}" method="POST" class="tambah-ke-keranjang">
        @csrf
        <div>
        </div>
        <input type="hidden" name="id" value="{{ $barang->id }}">
        <label for="tempat">Tempat:</label>
        <input type="text" name="tempat" required>
        <label for="pembayaran">Pembayaran:</label>
        <select name="pembayaran" id="pembayaran">
            <option value="COD">COD</option>
        </select>
        
        <label for="jumlah_barang">Jumlah Barang:</label>
        <input type="number" name="jumlah_barang" id="jumlah_barang">
        <button type="submit">Tambah ke Keranjang</button>
    </form>
</div>

<footer>
    Hak Cipta &copy; Kantin Amay 2024.
</footer>
</body>
</html>
