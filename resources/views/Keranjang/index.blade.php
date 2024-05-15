@extends('layouts.app')

@section('content')
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
            @foreach ($keranjang as $item)
            <tr>
                <td>{{ $item->barang->nama }}</td>
                <td>Rp {{ number_format($item->barang->harga, 0, ',', '.') }}</td>
                <td>{{ $item->jumlah }}</td>
                <td>Rp {{ number_format($item->barang->harga * $item->jumlah, 0, ',', '.') }}</td>
                <td>
                    <form action="{{ route('keranjang.hapus', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="text-right">
        <a href="{{ route('checkout') }}" class="btn btn-primary">Checkout</a>
    </div>
    @endif
</div>
@endsection
