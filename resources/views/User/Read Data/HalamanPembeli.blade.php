<!-- resources/views/User/ReadData/HalamanPembeli.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Pembeli</title>
    <style>
        /* General styles for the body */
        body {
            font-family: Arial, sans-serif;
            background-color: white;
            margin: 0;
            padding: 0;
        }

        /* Header styles */
        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #FFA500;
            padding: 10px 20px;
            border-bottom: 1px solid #e0e0e0;
        }

        /* Navigation styles */
        nav {
            display: flex;
            align-items: center;
        }

        /* Dropdown menu styles */
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

        /* Logout link styles */
        .logout-link {
            margin-left: 20px;
            color: white;
            background-color: #007bff;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .logout-link:hover {
            background-color: #0056b3;
        }

        /* Main content styles */
        main {
            padding: 20px;
            text-align: center;
        }

        /* Button styles */
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

        /* Table styles */
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
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

        /* Footer styles */
        footer {
            background-color: #FFA500;
            color: white;
            text-align: center;
            padding: 5px 0;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
        .yap {
            position: fixed;
            left: 1%;
            top: 12%;
            color: white;
        }
        .arrowleft {
            border: solid white;
            border-width: 0 3px 3px 0;
            display: inline-block;
            padding: 3px;
            transform: rotate(135deg);
            -webkit-transform: rotate(135deg);
        }
        .delete {
            background-color: #ff4444;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .delete:hover {
            background-color: #cc0000;
        }

        .ubah {
            background-color: blue;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .ubah:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="yap">
    <a href="{{ route('halamanUser') }}"><i class="arrowleft"></i></a>
</div>
    <header>
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
                    window.location = "{{ url('/') }}"; // Redirect to homepage if not admin
                </script>
            @endif
        </nav>
    </header>
    <main>
    <main>
        <h3>Read</h3>
        <a href="{{ route('HalamanReadBarang') }}">Barang</a>
        <a href="{{ route('HalamanReadPembeli') }}">Pembeli</a>
        <a href="{{ route('HalamanReadPenjual') }}">Penjual</a>
    </main>
        <h3>Daftar Akun Pembeli</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pembeli as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                        <form style="display: inline-block;" action="{{ route('userdestroy', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="delete" type="submit" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Nama {{ $user->name}}?');">Hapus</button>
                        </form>
                        <a href="{{ route('HalamanUbahUser', ['id' => $user->id]) }}" style="display: inline-block;" class="ubah">Ubah</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
    <footer>
        Hak Cipta &copy; Kantin Amay 2024.
    </footer>
</body>
</html>
