<div class="container">
    <h1>Checkout</h1>
    <!-- Tampilkan daftar barang dari keranjang belanja -->
    @foreach ($keranjang as $item)
        <p>Nama Barang: {{ $item['nama_barang'] }}</p>
        <p>Jumlah: {{ $item['jumlah_barang'] }}</p>
        <!-- Tambahkan informasi barang lainnya yang diperlukan -->
    @endforeach

    <!-- Tambahkan formulir dan logika untuk pembayaran -->
</div>
