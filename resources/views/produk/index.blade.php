@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Data Produk</h2>
        <a href="{{ route('produk.create') }}" class="btn btn-primary">Tambah Produk</a>

        @if (session('success'))
            <div class="alert alert-success mt-2">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($produk as $item)
                    <tr>
                        <td>{{ $item->id_produk }}</td>
                        <td>{{ $item->nama_produk }}</td>
                        <td>{{ $item->harga }}</td>
                        <td>{{ $item->kategori->nama_kategori }}</td>
                        <td>{{ $item->status->nama_status }}</td>
                        <td>
                            <a href="{{ route('produk.edit', $item->id_produk) }}" class="btn btn-sm btn-primary">Edit</a>
                            <button onclick="konfirmasiHapus({{ $item->id_produk }})"
                                class="btn btn-sm btn-danger">Hapus</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        // Fungsi ini akan dipanggil saat tombol "Hapus" ditekan
        function konfirmasiHapus(id) {
            if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                // Jika pengguna menekan OK, maka arahkan ke rute hapus dengan ID produk
                window.location.href = '/produk/' + id + '/delete';
            }
        }
    </script>
@endsection
