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
            background-color: #FFA500;
            color: white;
            padding: 10px 0;
            text-align: center;
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
        .dropbtn {
            background-color: #04AA6D;
            color: white;
            padding: 16px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }
        .dropdown {
            position: relative;
            display: inline-block;
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
            background-color: #3e8e41;
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
            padding: 10px 0;
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
                        a{color: black;
                            font-size: xx-large;}
    </style>
</head>
<body>
    <header>
        <h2>Halaman Admin</h2>
    </header>
    <main>
        <div class="dropdown">
            <button class="dropbtn">Registrasi</button>
            <div class="dropdown-content">
                <a href="{{ route('HalamanRegistrasiPenjual') }}">Registrasi Penjual</a>
                <a href="{{ route('HalamanRegistrasiPembeli') }}">Registrasi Pembeli</a>
            </div>
        </div>
        <div class="dropdown">
            <button class="dropbtn">Tambah Barang</button>
            <div class="dropdown-content">
                <a href="{{ route('HalamanTambahBarang') }}">Tambah Barang</a>
            </div>
        </div>

        <h3>Daftar Barang Penjual</h3>
        <table>
            <thead>
                <tr>
                    <th>ID Penjual</th>
                    <th>Nama Barang</th>
                    <th>Jenis Barang</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($barangs as $barang)
                <tr>
                    <td>{{ $barang->id_penjual }}</td>
                    <td>{{ $barang->nama_barang }}</td>
                    <td>{{ $barang->jenis_barang }}</td>
                    <td>Rp {{ number_format($barang->harga_barang, 0, ',', '.') }}</td>
                    <td>{{ $barang->jumlah_barang }}</td>
                    <td><img src="{{ asset('/storage/images/' . $barang->image) }}" alt="{{ $barang->nama_barang }}" class="img_thumbnail"></td>
                    <td>
                        <form style="display: inline-block;" action="{{ route('barangdestroy', $barang->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="delete" type="submit" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data {{ $barang->nama_lengkap}}?');">Hapus</button>
                        </form>
                </tr>
                @endforeach
            </tbody>
        </table>

        <h3>Daftar Akun Pembeli</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No Hp</th>
                    <th>JK</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pembelis as $pembeli)
                <tr>
                    <td>{{ $pembeli->id }}</td>
                    <td>{{ $pembeli->nama_pembeli }}</td>
                    <td>{{ $pembeli->alamat_pembeli}}</td>
                    <td>{{ $pembeli->no_hp_pembeli}}</td>
                    <td>{{ $pembeli->jk_pembeli}}</td>
                    <td>
                        <form style="display: inline-block;" action="{{ route('pembelidestroy', $pembeli->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="delete" type="submit" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data {{ $barang->nama_lengkap}}?');">Hapus</button>
                        </form>
                </tr>
                @endforeach
            </tbody>
        </table>
        <h3>Daftar Akun Penjual</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No Hp</th>
                    <th>Email</th>
                    <th>JK</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($penjuals as $penjual)
                <tr>
                    <td>{{ $penjual->id }}</td>
                    <td>{{ $penjual->nama_penjual }}</td>
                    <td>{{ $penjual->alamat_penjual}}</td>
                    <td>{{ $penjual->no_hp_penjual}}</td>
                    <td>{{ $penjual->email_penjual}}</td>
                    <td>{{ $penjual->jk_penjual}}</td>
                    <td>
                        <form style="display: inline-block;" action="{{ route('penjualdestroy', $penjual->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="delete" type="submit" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data {{ $barang->nama_lengkap}}?');">Hapus</button>
                        </form>
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
