<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Products - SantriKoding.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background: lightgray">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <a href="{{ route('books.create') }}" class="btn btn-md btn-success">ADD PRODUCT</a>
                            <button onclick="logoutUser()" class="btn btn-md btn-danger">LOGOUT</button>
                        </div>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">TITLE</th>
                                    <th scope="col">AUTHOR</th>
                                    <th scope="col">PRICE</th>
                                    <th scope="col">STOCK</th>
                                    <th scope="col" style="width: 20%">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($books as $book)
                                <tr>
                                    <td>{{ $book->title }}</td>
                                    <td>{{ $book->author }}</td>
                                    <td>{{ "Rp " . number_format($book->price,2,',','.') }}</td>
                                    <td>{{ $book->stock }}</td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('books.destroy', $book->id) }}" method="POST">
                                            <a href="{{ route('books.show', $book->id) }}" class="btn btn-sm btn-dark">SHOW</a>
                                            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <div class="alert alert-danger">
                                    Data Products belum ada.
                                </div>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $books->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // 🔐 CEK apakah token tersedia
        const token = localStorage.getItem("auth_token");

        if (!token) {
            // Jika tidak ada token, redirect ke login
            window.location.href = "/auth";
        }

        // ⏏️ Logout handler
        function logoutUser() {
            localStorage.removeItem("auth_token"); // hapus token
            window.location.href = "/auth"; // kembali ke halaman login
        }
    </script>


    <script>
        const perfEntries = performance.getEntriesByType("navigation");
        const isBackForward = perfEntries.length > 0 && perfEntries[0].type === "back_forward";

        // Jika BUKAN hasil dari tombol back/forward, baru tampilkan notifikasi
        if (!isBackForward) {
            @if(session('success'))
            Swal.fire({
                icon: "success",
                title: "BERHASIL",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
            @endif

            @if(session('error'))
            Swal.fire({
                icon: "error",
                title: "GAGAL!",
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
            @endif
        }
    </script>


</body>

</html>