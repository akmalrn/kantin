<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: white;
            margin: 0;
            padding: 0;
        }
        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #FFA500;
            padding: 10px 20px;
            border-bottom: 1px solid #e0e0e0;
        }
        nav {
            display: flex;
            align-items: center;
        }
        .dropdown {
            position: relative;
            display: inline-block;
        }
        .dropbtn {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            border-radius: 20%;
        }
        .dropdown-content {
            display: none;
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
        .dropdown:hover .dropdown-content {
            display: block;
        }
        .dropdown:hover .dropbtn {
            background-color: #0056b3;
        }
        .logout-link {
            margin-left: 20px;
        }
        main {
            padding: 20px;
            text-align: center;
        }
        a {
            display: inline-block;
            margin: 10px;
            padding: 10px 20px;
            text-decoration: none;
            color: white;
            background-color: #007BFF;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        a:hover {
            background-color: #0056b3;
        }
        
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .img_thumbnail {
            width: 100px;
        }
        footer {
            background-color: #FFA500;
            color: white;
            text-align: center;
            padding: 5px 0;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
                                        .tambahbarang{position: fixed;
                                        bottom : 12%;
                                        padding:10px;
                                        right:2%;
                                        background-color: white;
                                        box-shadow: 0px 0px 1px 0px black;}
                                        a{color: black;}
    </style>
</head>
<body>
<header>
@if (Auth::check() && Auth::user()->role == 'admin')
        <h2>Halaman Admin</h2>
        <nav>
            <div class="dropdown">
                <button class="dropbtn">Registrasi</button>
                <div class="dropdown-content">
                    <a href="{{ route('HalamanRegistrasiUser') }}">Registrasi Pembeli</a>
                    <a href="{{ route('HalamanRegistrasiPenjual') }}">Registrasi Penjual</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropbtn">Barang</button>
                <div class="dropdown-content">
                    <a href="{{ route('HalamanTambahBarang') }}">Tambah Barang</a>
                    <a href="{{ route('Pembelian') }}">Halaman Pembelian</a>
                </div>
            </div>
            @if (Auth::check() && Auth::user()->role == 'admin')
                <form id="logout-form" action="{{ route('logoutUser') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a class="logout-link" href="#" onclick="event.preventDefault(); if (confirm('Apakah Anda yakin ingin logout?')) { document.getElementById('logout-form').submit(); }">
                    Logout
                </a>
            @else
                <script type="text/javascript">
                    window.location = "{{ rote('halamanLoginUser') }}"; // Redirect to homepage if not admin
                </script>
            @endif

        </nav>
    </header>
    <main>
        <h3>Read</h3>
        <a href="{{ route('HalamanReadBarang') }}">Barang</a>
        <a href="{{ route('HalamanReadPembeli') }}">Pembeli</a>
        <a href="{{ route('HalamanReadPenjual') }}">Penjual</a>
    </main>
    <footer>
        Hak Cipta &copy; Kantin Amay 2024.
    </footer>
</body>
@endif
@if (Auth::check() && Auth::user()->role == 'pembeli')
<form id="logout-form-pembeli" action="{{ route('logoutya') }}" method="POST" >
                    @csrf
                </form>
                <a href="#" onclick="event.preventDefault(); if (confirm('Apakah Anda yakin ingin logout?')) { document.getElementById('logout-form-pembeli').submit(); }">
                    Silahkan Logout 
                </a>
                                        </form>
@endif
</html>
