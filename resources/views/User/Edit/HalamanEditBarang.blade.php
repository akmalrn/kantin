<!-- resources/views/User/EditData/HalamanEditBarang.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
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

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        /* Image preview styles */
        .img_thumbnail {
            width: 200px; /* Atur lebar gambar */
            height: 150px; /* Atur tinggi gambar */
            object-fit: cover;
            border-radius: 4px;
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
    <a href="{{ route('HalamanReadBarang') }}"><i class="arrowleft"></i></a>
</div>
    <header>
        <h2>Edit Barang</h2>
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
        <h3>Edit Barang: {{ $barang->nama_barang }}</h3>
        <form action="{{ route('MemperbaruiBarangs', $barang->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <label for="nama_barang">Nama Barang</label>
            <input type="text" id="nama_barang" name="nama_barang" value="{{ old('nama_barang', $barang->nama_barang) }}" required>

            
            <label for="jenis_barang">Jenis Barang:</label>
            <select name="jenis_barang" id="jenis_barang">
           <option value="Makanan">Makanan</option>
           <option value="Minuman">Minuman</option>
            </select>
        

            <label for="harga_barang">Harga Barang</label>
            <input type="number" id="harga_barang" name="harga_barang" value="{{ old('harga_barang', $barang->harga_barang) }}" required>

            <label for="jumlah_barang">Jumlah Barang</label>
            <input type="number" id="jumlah_barang" name="jumlah_barang" value="{{ old('jumlah_barang', $barang->jumlah_barang) }}" required>

            <label for="image">Gambar Barang</label>
            @if($barang->image)
            <img src="{{ asset('storage/images/' . $barang->image) }}" alt="{{ $barang->nama_barang }}" class="img_thumbnail">
            @endif
            <input type="file" id="image" name="image">

            <input type="submit" value="Update Barang">
        </form>
    </main>
    <footer>
        Hak Cipta &copy; Kantin Amay 2024.
    </footer>
</body>
</html>
