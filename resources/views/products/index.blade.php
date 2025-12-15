<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5 pb-5" style="padding-bottom: 80px;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 style="color: #800020; font-weight: bold;">Belanja Dulu</h2>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1000;">
            <a href="{{ route('products.create') }}" class="btn" style="background-color: #800020; color: white;">Tambah Produk</a>
        </div>

        {{-- Loop Data Kategori --}}
        <div class="row">
            @forelse ($categories as $category)
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="card-header" style="background-color: #800020; color: white;">
                            <h5 class="mb-0">{{ $category->name }}</h5>
                        </div>
                        <div class="card-body">
                            @if($category->products->count() > 0)
                                <table class="table table-sm table-striped table-hover table-bordered" style="border-radius: 8px; overflow: hidden;">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Produk</th>
                                            <th>Deskripsi</th>
                                            <th>Harga</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($category->products as $product)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->description }}</td>
                                                <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                                <td>
                                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm me-1">Edit</a>
                                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus produk ini?')">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="text-muted">Belum ada produk di kategori ini.</p>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">Data kategori tidak tersedia.</div>
                </div>
            @endforelse
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Hide alert after 5 seconds
        setTimeout(function() {
            const alert = document.querySelector('.alert');
            if (alert) {
                alert.style.display = 'none';
            }
        }, 5000);
    </script>
</body>
</html>