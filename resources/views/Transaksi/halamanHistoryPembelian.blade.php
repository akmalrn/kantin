<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Berhasil</title>
    <style>
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Custom CSS */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .transaction-item {
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 20px;
        }

        .transaction-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }

        .transaction-item img {
            width: 100px;
            height: auto;
            display: block;
            margin: 0 auto 10px;
            border-radius: 8px;
        }

        .transaction-details {
            text-align: center;
        }

        .transaction-details p {
            margin-bottom: 10px;
        }

        .btn-back {
            display: block;
            width: 200px;
            margin: 0 auto;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .btn-back:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Transaksi Berhasil</h2>
    @if(!empty($transaksiItems))
        @foreach ($transaksiItems as $transaksi)
            @php
                $barang = \App\Models\Barang::find($transaksi->id_barang);
            @endphp
            <div class="transaction-item">
                <img src="{{ asset('storage/images/' . $barang->image) }}" alt="{{ $barang->nama_barang }}">
                <div class="transaction-details">
                    <p><strong>ID Penjual:</strong> {{ $barang->id_penjual }}</p>
                    <p><strong>Nama Barang:</strong> {{ $barang->nama_barang }}</p>
                    <p><strong>Harga:</strong> Rp {{ number_format($barang->harga_barang, 0, ',', '.') }}</p>
                    <p><strong>Jumlah:</strong> {{ $transaksi->jumlah_barang }}</p>
                    <p><strong>Total:</strong> Rp {{ number_format($barang->harga_barang * $transaksi->jumlah_barang, 0, ',', '.') }}</p>
                </div>
            </div>
        @endforeach
    @else
        <p>Tidak ada transaksi.</p>
    @endif
    <a href="{{ route('Pembelian') }}" class="btn-back">Kembali</a>
</div>
</body>
</html>
