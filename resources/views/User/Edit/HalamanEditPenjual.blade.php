<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Penjual</title>
    <style>
        /* General styles */
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
            max-width: 600px;
            margin: 0 auto;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        input, select, textarea {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"], button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover, button:hover {
            background-color: #45a049;
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

        /* Back to home icon */
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
    </style>
</head>
<body>
    <div class="home">
        <a href="{{ route('HalamanReadPenjual') }}"><i class="arrowleft"></i></a>
    </div>
    <header>
        <h2>Edit Penjual</h2>
        <nav>
            <div class="dropdown">
                <button class="dropbtn">Registrasi</button>
                <div class="dropdown-content">
                    <a href="{{ route('HalamanRegistrasiUser') }}">Registrasi</a>
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
        <h3>Edit Penjual: {{ $penjual->nama_penjual }}</h3>
        <form action="{{ route('MemperbaruiPenjuals', $penjual->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="nama_penjual">Nama Penjual</label>
            <input type="text" id="nama_penjual" name="nama_penjual" value="{{ old('nama_penjual', $penjual->nama_penjual) }}" required>

            <label for="password_penjual">Password (kosongkan jika tidak ingin mengubah)</label>
            <input type="password" id="password_penjual" name="password_penjual">

            <label for="alamat_penjual">Alamat Penjual</label>
            <input type="text" id="alamat_penjual" name="alamat_penjual" value="{{ old('alamat_penjual', $penjual->alamat_penjual) }}" required>

            <label for="no_hp_penjual">Nomor Telepon Penjual</label>
            <input type="text" id="no_hp_penjual" name="no_hp_penjual" value="{{ old('no_hp_penjual', $penjual->no_hp_penjual) }}" required>

            <label for="email_penjual">Email Penjual</label>
            <input type="email" id="email_penjual" name="email_penjual" value="{{ old('email_penjual', $penjual->email_penjual) }}" required>

            <label for="jk_penjual">Jenis Kelamin Penjual</label>
            <select name="jk_penjual" id="jk_penjual">
                <option value="Laki-laki" {{ $penjual->jk_penjual == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ $penjual->jk_penjual == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>

            <br><br>
            <input type="submit" value="Update Penjual">
        </form>
    </main>
    <footer>
        Hak Cipta &copy; Kantin Amay 2024.
    </footer>
</body>
</html>
