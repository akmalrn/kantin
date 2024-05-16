<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Tambah Barang Penjual</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 500px;
    margin: 50px auto; /* Tengah secara vertikal dan horizontal */
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    margin-bottom: 20px;
}

form {
    margin-top: 20px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="text"],
input[type="number"],
select {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

.button1 {
    text-align: center;
}

button[type="submit"] {
    width: 50%;
    padding: 10px;
    background-color: red;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button[type="submit"]:hover {
    background-color: #45a049;
}
footer{background-color: #FFA500;
                    padding: 10px;
                    position: fixed;
                            bottom: 0;
                        width: 100%;}

                    header{background-color: #FFA500;
                    padding: 10px;
                            top: 0;
                        width: 100%;}

            .home{
            position: fixed;
            top: 8%;
            left: 1%;
            color: white;
            background-color: red;
            padding: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        }
        .arrowleft{
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

<div  class="home" >
        <a href="{{ route('Pembelian') }}"><i class="arrowleft"></i></a>
        </div>  

<header>@ Amay Kantin</header>
    <h1>Tambah Barang</h1>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('tambahBarang') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div>
    <label for="id_penjual">Nama Penjual:</label>
    <select name="id_penjual" id="id_penjual">
        @foreach($penjuals as $penjual)
            <option value="{{ $penjual->id }}">{{ $penjual->nama_penjual }}</option>
        @endforeach
    </select>
</div>
        <div>
            <label for="jenis_barang">Jenis Barang:</label>
            <select name="jenis_barang" id="jenis_barang">
           <option value="Makanan">Makanan</option>
           <option value="Minuman">Minuman</option>
            </select>
        </div>
        <div>
            <label for="nama_barang">Nama Barang:</label>
            <input type="text" id="nama_barang" name="nama_barang" value="{{ old('nama_barang') }}" required>
        </div>
        <div>
                <label for="image">Gambar Barang:</label>
                <input type="file" id="image" name="image">
            </div>
        <div>
            <label for="harga_barang">Harga Barang:</label>
            <input type="number" id="harga_barang" name="harga_barang" value="{{ old('harga_barang') }}" required>
        </div>
        <div>
            <label for="jumlah_barang">Jumlah Barang:</label>
            <input type="number" id="jumlah_barang" name="jumlah_barang" value="{{ old('jumlah_barang') }}" required>
        </div>
        <div style="text-align: center;">
            <button type="submit" onclick="return confirm('Apakah Anda Sudah Benar??')" >Simpan</button>
        </div>
    </form>
</body>
<footer>
    Hak Cipta &copy; Kantin Amay 2024.
</footer>
</html>
