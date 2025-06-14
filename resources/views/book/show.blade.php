<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Buku - {{ $book->title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #f8f9fa">

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="mb-4 text-center">
                    <h2 class="fw-bold"><i class="bi bi-book"></i> Detail Buku</h2>
                    <p class="text-muted">Informasi lengkap mengenai buku yang dipilih</p>
                </div>

                <div class="card shadow-sm border-0 rounded">
                    <div class="card-body">
                        <h4 class="fw-bold mb-2">{{ $book->title }}</h4>
                        <p class="text-secondary mb-3">Ditulis oleh <strong>{{ $book->author }}</strong></p>
                        <hr>

                        <p class="mb-2"><strong>Harga:</strong> <span class="text-success fw-bold">{{ "Rp " . number_format($book->price,2,',','.') }}</span></p>
                        <p class="mb-2"><strong>Stok Tersedia:</strong> {{ $book->stock }} unit</p>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('books.index') }}" class="btn btn-secondary">← Kembali ke Daftar Buku</a>
                </div>

            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Optional: Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</body>
</html>
