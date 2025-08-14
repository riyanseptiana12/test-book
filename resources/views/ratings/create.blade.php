@extends('layouts.app')

@section('title', 'Tambah Rating - BookStore App')
@section('page-title', 'Tambah Rating Buku')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">

        <div class="card mb-4">
            <div class="card-body bg-info bg-opacity-10">
                <div class="d-flex align-items-center">
                    <i class="bi bi-lightbulb-fill text-info fs-3 me-3"></i>
                    <div>
                        <h6 class="mb-1">Cara Menggunakan:</h6>
                        <p class="mb-0 text-muted">Pilih penulis terlebih dahulu, lalu pilih buku dari penulis tersebut, dan berikan rating 1-10</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header text-center">
                <h4 class="mb-0">
                    <i class="bi bi-star-fill me-2"></i>Form Input Rating
                </h4>
                <p class="mb-0 mt-2 opacity-75">Berikan rating untuk buku favorit Anda</p>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('ratings.store') }}">
                    @csrf


                    <div class="mb-4">
                        <label for="author_id" class="form-label">
                            <i class="bi bi-person-fill me-1"></i>Penulis Buku: <span class="text-danger">*</span>
                        </label>
                        <select name="author_id" id="author_id" class="form-select" required>
                            <option value="">-- Pilih Penulis --</option>
                            @foreach($authors as $author)
                                <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>
                                    {{ $author->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="form-text">Pilih penulis untuk melihat daftar bukunya</div>
                    </div>


                    <div class="mb-4">
                        <label for="book_id" class="form-label">
                            <i class="bi bi-book-fill me-1"></i>Nama Buku: <span class="text-danger">*</span>
                        </label>
                        <select name="book_id" id="book_id" class="form-select" required disabled>
                            <option value="">-- Pilih penulis terlebih dahulu --</option>
                        </select>
                        <div class="form-text">Daftar buku akan muncul setelah memilih penulis</div>
                        <div id="loading-books" class="text-center mt-2" style="display: none;">
                            <div class="spinner-border spinner-border-sm text-primary me-2" role="status"></div>
                            <span class="text-muted">Memuat daftar buku...</span>
                        </div>
                    </div>


                    <div class="mb-4">
                        <label for="rating" class="form-label">
                            <i class="bi bi-star-half me-1"></i>Rating: <span class="text-danger">*</span>
                        </label>
                        <select name="rating" id="rating" class="form-select" required>
                            <option value="">-- Pilih Rating (1-10) --</option>
                            @for($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }}" {{ old('rating') == $i ? 'selected' : '' }}>
                                    {{ $i }} {{ $i <= 5 ? '⭐' : '⭐⭐' }} - {{
                                        $i == 1 ? 'Sangat Buruk' :
                                        ($i == 2 ? 'Buruk' :
                                        ($i == 3 ? 'Kurang' :
                                        ($i == 4 ? 'Biasa' :
                                        ($i == 5 ? 'Cukup' :
                                        ($i == 6 ? 'Lumayan' :
                                        ($i == 7 ? 'Bagus' :
                                        ($i == 8 ? 'Sangat Bagus' :
                                        ($i == 9 ? 'Luar Biasa' : 'Masterpiece'))))))))
                                    }}
                                </option>
                            @endfor
                        </select>
                        <div class="form-text">Berikan rating dari 1 (terburuk) hingga 10 (terbaik)</div>

                        <div class="mt-3 p-3 bg-light rounded">
                            <div class="row text-center small">
                                <div class="col">
                                    <div class="text-danger">1-3</div>
                                    <div>Kurang</div>
                                </div>
                                <div class="col">
                                    <div class="text-warning">4-6</div>
                                    <div>Biasa</div>
                                </div>
                                <div class="col">
                                    <div class="text-success">7-8</div>
                                    <div>Bagus</div>
                                </div>
                                <div class="col">
                                    <div class="text-primary">9-10</div>
                                    <div>Excellent</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg" id="submit-btn">
                            <i class="bi bi-send-fill me-2"></i>SUBMIT RATING
                        </button>
                        <a href="{{ route('books.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1"></i>Kembali ke Daftar Buku
                        </a>
                    </div>
                </form>
            </div>
            <div class="card-footer bg-light">
                <div class="text-center">
                    <small class="text-muted">
                        <i class="bi bi-shield-check me-1"></i>Rating Anda akan membantu pengguna lain dalam memilih buku
                    </small>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h6 class="mb-0">
                    <i class="bi bi-clock-history me-1"></i>Tips Rating
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <ul class="list-unstyled">
                            <li><i class="bi bi-check-circle text-success me-2"></i>Rating 1-5: Untuk buku yang kurang memuaskan</li>
                            <li><i class="bi bi-check-circle text-success me-2"></i>Rating 6-8: Untuk buku yang bagus dan direkomendasikan</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-unstyled">
                            <li><i class="bi bi-check-circle text-success me-2"></i>Rating 9-10: Untuk buku yang luar biasa</li>
                            <li><i class="bi bi-check-circle text-success me-2"></i>Rating akan mempengaruhi popularitas penulis</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.getElementById('author_id').addEventListener('change', function() {
    const authorId = this.value;
    const bookSelect = document.getElementById('book_id');
    const loadingDiv = document.getElementById('loading-books');
    const submitBtn = document.getElementById('submit-btn');

    if (authorId) {

        loadingDiv.style.display = 'block';
        bookSelect.disabled = true;
        bookSelect.innerHTML = '<option value="">Memuat...</option>';

        fetch(`/api/authors/${authorId}/books`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(books => {
                bookSelect.innerHTML = '<option value="">-- Pilih Buku --</option>';
                if (books.length > 0) {
                    books.forEach(book => {
                        bookSelect.innerHTML += `<option value="${book.id}">${book.name}</option>`;
                    });
                    bookSelect.disabled = false;
                } else {
                    bookSelect.innerHTML = '<option value="">Tidak ada buku dari penulis ini</option>';
                }
                loadingDiv.style.display = 'none';
            })
            .catch(error => {
                console.error('Error:', error);
                bookSelect.innerHTML = '<option value="">Error: Gagal memuat buku</option>';
                bookSelect.disabled = true;
                loadingDiv.style.display = 'none';


                const alert = document.createElement('div');
                alert.className = 'alert alert-danger alert-dismissible fade show mt-3';
                alert.innerHTML = `
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    Gagal memuat daftar buku. Silakan coba lagi.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                `;
                bookSelect.parentNode.appendChild(alert);
            });
    } else {
        bookSelect.innerHTML = '<option value="">-- Pilih penulis terlebih dahulu --</option>';
        bookSelect.disabled = true;
        loadingDiv.style.display = 'none';
    }
});


document.querySelector('form').addEventListener('submit', function(e) {
    const authorId = document.getElementById('author_id').value;
    const bookId = document.getElementById('book_id').value;
    const rating = document.getElementById('rating').value;

    if (!authorId || !bookId || !rating) {
        e.preventDefault();
        alert('Mohon lengkapi semua field yang wajib diisi!');
        return false;
    }


    const submitBtn = document.getElementById('submit-btn');
    submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Menyimpan...';
    submitBtn.disabled = true;
});


setTimeout(function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        if (alert.classList.contains('show')) {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }
    });
}, 5000);
</script>
@endsection
