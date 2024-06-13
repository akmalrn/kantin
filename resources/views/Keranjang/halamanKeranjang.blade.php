<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Keranjang Belanja</title>
    <style>
        body {
            background-color: white;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #FFA500;
            padding: 5px 20px;
            text-align: center;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }
        .container {
            max-width: 1000px;
            margin: 80px auto 0;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }
        .alert-success {
            color: #3c763d;
            background-color: #dff0d8;
            border-color: #d6e9c6;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th, .table td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .table th {
            background-color: #f2f2f2;
        }
        .btn {
            display: inline-block;
            padding: 6px 12px;
            margin-bottom: 0;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.42857143;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            cursor: pointer;
            border: 1px solid transparent;
            border-radius: 4px;
        }
        .btn-primary {
            color: #fff;
            background-color: #337ab7;
            border-color: #2e6da4;
        }
        .btn-danger {
            color: #fff;
            background-color: #d9534f;
            border-color: #d43f3a;
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
        .img_thumbnail {
            width: 100px;
        }
        footer {
            background-color: #FFA500;
            padding: 5px;
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
        }
        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            text-align: center;
        }
        nav ul li {
            display: inline;
            margin: 0 10px;
        }
        nav ul li a {
            text-decoration: none;
            color: #fff;
            padding: 5px 10px;
            border-radius: 4px;
        }
        nav ul li a:hover {
            background-color: #d9534f;
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
<div class="home">
    <a href="{{ route('Pembelian') }}"><i class="arrowleft"></i></a>
</div>
<header>
    <div>@ Amay Kantin</div>
    <nav>
    @if (Auth::check())
    <div class="user-dropdown">
        <span class="username">{{ Auth::user()->name }}
            </span> <!-- Menampilkan nama pengguna -->
        <div class="dropdown-content">
            @if (Auth::user()->role == 'pembeli')
            <span class="arrow-down"></span> <!-- Panah ke bawah -->
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

    <div class="container">
        <h1>Keranjang Belanja</h1>

        <!-- Tampilkan pesan sukses jika ada -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Cek apakah keranjang kosong atau tidak -->
        @if ($keranjang->isEmpty())
            <p>Keranjang belanja Anda kosong.</p>
        @else
            <!-- Tabel untuk menampilkan barang di keranjang -->
            <table class="table">
                <thead>
                    <!-- Kolom-kolom tabel -->
                    <tr>
                        <th>Gambar</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Status Barang</th>
                        <th>Tempat</th>
                        <th>Pembayaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Loop untuk setiap item di keranjang -->
                    @foreach ($keranjang as $item)
                        <tr>
                            <!-- Tampilkan detail setiap barang di sini -->
                            <td><img src="{{ asset('storage/images/' . $item->barang->image) }}" alt="{{ $item->barang->nama_barang }}" class="img_thumbnail"></td>
                            <td>{{ $item->barang->nama_barang }}</td>
                            <td>Rp {{ number_format($item->barang->harga_barang, 0, ',', '.') }}</td>
                            <td>{{ $item->jumlah_barang }}</td>
                            <td>Rp {{ number_format($item->subtotal(), 0, ',', '.') }}</td>
                            <td>{{ $item->status_barang }}</td>
                            <td>{{ $item->tempat }}</td>
                            <td>{{ $item->pembayaran }}</td>
                            <td>
                                <form style="display: inline-block;" action="{{ route('destroyKeranjang', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <!-- Tombol hapus untuk menghapus barang dari keranjang -->
                                    <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Nama {{ $item->barang->nama_barang }}?');">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Hitung total harga dari semua barang di keranjang -->
            @php
                $totalHarga = 0;
                foreach ($keranjang as $item) {
                    $totalHarga += $item->subtotal();
                }
            @endphp

            <!-- Tampilkan total harga -->
            <div style="text-align: center;">Total Harga: Rp {{ number_format($totalHarga, 0, ',', '.') }}</div>
                <br>
            <!-- Tombol checkout -->
            <form action="{{ route('process') }}" method="POST" style="text-align: center;">
    @csrf
    @foreach ($keranjang as $item)
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
    @endforeach
    <button type="submit" class="btn btn-primary">Checkout</button>
</form>

        @endif
    </div>

    <footer>
        Hak Cipta &copy; Kantin Amay 2024.
    </footer>
</body>
</html>
