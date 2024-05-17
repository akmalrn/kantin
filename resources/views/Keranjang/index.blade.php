<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <style>
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
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
        .home{
            position: fixed;
            top: 5%;
            left: 1%;
            color: white;
            background-color: #337ab7;
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
<div class="container">
    <h1>Keranjang Belanja</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (empty($keranjang))
        <p>Keranjang belanja Anda kosong.</p>
    @else
    <div  class="home" >
        <a href="{{ route('Pembelian') }}"><i class="arrowleft"></i></a>
        </div> 
        <form action="{{ route('process') }}" method="POST">
    @csrf
    <table class="table">
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($keranjang as $item)
                @php
                    $keranjang = \App\Models\Keranjang::find($item['id']);
                    $barang = \App\Models\Barang::find($item['id_barang']);
                @endphp
                <tr>
                    <td>{{ $barang->nama_barang }}</td>
                    <td>Rp {{ number_format($barang->harga_barang, 0, ',', '.') }}</td>
                    <td>{{ $item['jumlah_barang'] }}</td>
                    <td>Rp {{ number_format($barang->harga_barang * $item['jumlah_barang'], 0, ',', '.') }}</td>
                    <td>
                        <form style="display: inline-block;" action="{{ route('keranjangdestroy', $keranjang->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus {{ $barang->nama_barang }}?');">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <button type="submit" class="btn btn-primary">Checkout</button>
</form>

    @endif
</div>
</body>
</html>
