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

</style>


<div class="container">
    <h1>Keranjang Belanja</h1>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    @if ($keranjang->isEmpty())
    <p>Keranjang belanja Anda kosong.</p>
    @else
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
            @foreach ($barangs as $barang) 
            @foreach ($barangs as $keranjang)
            <tr>
                <td>{{ $barang->nama_barang }}</td>
                <td>Rp {{ number_format($barang->harga_barang, 0, ',', '.') }}</td>
                <td>{{ $barang->jumlah_barang }}</td>
                <td>Rp {{ number_format($barang->harga_barang * $keranjang->jumlah_barang, 0, ',', '.') }}</td>
                <td>
                    <form action="{{ route('keranjang.hapus', $barang->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
            @endforeach
        </tbody>
    </table>
    <div class="text-right">
        <a href="{{ route('checkout') }}" class="btn btn-primary">Checkout</a>
    </div>
    @endif
</div>
