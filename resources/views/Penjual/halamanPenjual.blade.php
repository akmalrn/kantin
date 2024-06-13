<html>
    <head>
        <title>
            Halaman Penjual
        </title>
        <style>
            body {
            font-family: Arial, sans-serif;
            background-color: white;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1000px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        .actions {
            text-align: center;

        }

        .actions a {
            margin: 0 5px;
            padding: 5px 10px;
            text-decoration: none;
            color: white;
            background-color: #4caf50;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .actions a:hover {
            background-color: #45a049;
        }

        footer {
            background-color: #FFA500;
            padding: 20px;
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
        }

        header {
            background-color: #FFA500;
            padding: 20px;
            top: 0;
            width: 100%;
            text-align: center;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logout {
            margin-right: 20px;
        }

        .logout a {
            font-size: medium;
            color: white;
            text-decoration: none;
            background-color: #ff4500;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .logout a:hover {
            background-color: #e63900;
        }

        .img_thumbnail {
            width: 100px;
             /* Tinggi gambar akan disesuaikan agar proporsi tetap */
}

                        .tambahbarang{position: fixed;
                                        bottom : 12%;
                                        padding:10px;
                                        right:2%;
                                        background-color: white;
                                        box-shadow: 0px 0px 1px 0px black;}
                        a{color: black;
                            font-size: xx-large;}

                            h2{padding:20px;background-color: white; text-align: center;}

    .home {
        position: fixed;
        left: 2%;
        top: 8%;
        padding: 10px;
        background-color: #337ab7;
        border-radius: 10%;
        color: white;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        width: 10px;
        height: 10px;
    }

    .arrowleft {
        border: solid white;
        border-width: 0 2px 2px 0;
        display: inline-block;
        padding: 5px;
        transform: rotate(135deg);
        -webkit-transform: rotate(135deg);
        width: 2px;
        height: 2px;
    }
        </style>
    </head>
    <body>
    @if (Auth::check() && Auth::user()->role == 'admin')
    <div class="home">
        <a href="{{ route('halamanUser') }}"><i class="arrowleft"></i></a>
    </div>
@endif
            <header>@ Amay Kantin
            <div class="logout">
            <a href="{{ route('HalamanLoginPenjual') }}" onclick="return confirm('Apakah Anda Yakin Ingin Log Out')" >Logout</a>
        </div>
            </header>
            <h2>Penjual</h2>
            <div class="container">
        <h1>Daftar Barang Penjual</h1>
        <table>
            <thead style="text-align: center;">
                <tr>
                    <th>ID Penjual</th>
                    <th>Nama Barang</th>
                    <th>Jenis Barang</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Gambar</th>
                </tr>
            </thead>
            <tbody style="text-align: center;">
                @foreach($barangs as $barang)
                <tr>
                <td>{{ $barang->id_penjual}}</td>
                    <td>{{ $barang->nama_barang }}</td>
                    <td>{{ $barang->jenis_barang }}</td>
                    <td>Rp {{ number_format($barang->harga_barang, 0, ',', '.') }}</td>
                    <td>{{ $barang->jumlah_barang }}</td>
                    <td><img src="{{ asset('/storage/images/' . $barang->image) }}" alt="{{ $barang->nama_barang }}" class="img_thumbnail"></td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
                <div class="tambahbarang">
            <a href="{{ route('tambahBarang') }}">+</a>
                </div>
    </body>
    <footer>
    Hak Cipta &copy; Kantin Amay 2024.
</footer>
</html>