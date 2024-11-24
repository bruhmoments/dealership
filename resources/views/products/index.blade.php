@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="overflow-hidden overflow-x-auto border-b border-gray-200 bg-white p-6">
                <div class="container">
                    <h1>Daftar Produk</h1>

                    <!-- Tombol untuk menambahkan produk baru -->
                    <a href="{{ route('products.create') }}" class="btn btn-success mb-3">Tambah Produk Baru</a>

                    <!-- Menampilkan pesan sukses jika ada -->
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Menampilkan tabel daftar produk -->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Produk</th>
                                <th>Deskripsi</th>
                                <th>Harga</th>
                                <th>Kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->description }}</td>
                                <td>Rp. {{ number_format($product->price, 0, ",", ".") }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Menampilkan pagination -->
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
