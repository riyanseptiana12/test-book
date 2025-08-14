@extends('layouts.app')

@section('title', 'Daftar Buku - BookStore App')
@section('page-title', 'Daftar Buku')

@section('content')
<div class="row">
    <div class="col-12">

        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-funnel me-2"></i>Filter Pencarian</h5>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('books.index') }}">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label for="list_show" class="form-label">
                                <i class="bi bi-list-ol me-1"></i>Jumlah Tampilan:
                            </label>
                            <select name="list_show" id="list_show" class="form-select">
                                @for($i = 10; $i <= 100; $i += 10)
                                    <option value="{{ $i }}" {{ $listShow == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="search" class="form-label">
                                <i class="bi bi-search me-1"></i>Pencarian:
                            </label>
                            <input type="text" name="search" id="search" class="form-control"
                                   value="{{ $search }}" placeholder="Cari berdasarkan nama buku atau penulis...">
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-search me-1"></i>CARI
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Filter Section Auto Load -->
        {{-- <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-funnel me-2"></i>Filter Pencarian</h5>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('books.index') }}">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label for="list_show" class="form-label">
                                <i class="bi bi-list-ol me-1"></i>Jumlah Tampilan:
                            </label>
                            <select name="list_show" id="list_show" class="form-select">
                                @for($i = 10; $i <= 100; $i += 10)
                                    <option value="{{ $i }}" {{ $listShow == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="search" class="form-label">
                                <i class="bi bi-search me-1"></i>Pencarian:
                            </label>
                            <input type="text" name="search" id="search" class="form-control"
                                   value="{{ $search }}" placeholder="Cari berdasarkan nama buku atau penulis...">
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100" id="search-btn">
                                <i class="bi bi-search me-1"></i>CARI
                            </button>
                            <div class="spinner-border spinner-border-sm ms-2" role="status" id="loading-spinner" style="display: none;">
                                <span class="visually-hidden">Mencari...</span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div> --}}

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-book me-2"></i>Daftar Buku (Diurutkan berdasarkan Rating Tertinggi)</h5>
                <div>
                    <span class="badge bg-light text-dark">Total: {{ $books->count() }} buku</span>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th width="60">
                                    <i class="bi bi-hash me-1"></i>No
                                </th>
                                <th>
                                    <i class="bi bi-book me-1"></i>Nama Buku
                                </th>
                                <th>
                                    <i class="bi bi-tag me-1"></i>Kategori
                                </th>
                                <th>
                                    <i class="bi bi-person me-1"></i>Penulis
                                </th>
                                <th width="130" class="text-center">
                                    <i class="bi bi-star-fill me-1"></i>Rata-rata Rating
                                </th>
                                <th width="100" class="text-center">
                                    <i class="bi bi-people me-1"></i>Voter
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($books as $index => $book)
                                <tr>
                                    <td class="text-center">
                                        <span class="badge bg-primary rounded-pill">{{ $index + 1 }}</span>
                                    </td>
                                    <td>
                                        <strong>{{ $book->book_name }}</strong>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $book->category_name }}</span>
                                    </td>
                                    <td>{{ $book->author_name }}</td>
                                    <td class="text-center">
                                        @if($book->average_rating)
                                            <span class="badge bg-warning text-dark">
                                                <i class="bi bi-star-fill me-1"></i>{{ $book->average_rating }}
                                            </span>
                                        @else
                                            <span class="badge bg-secondary">Belum ada rating</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-info">{{ $book->voter }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="bi bi-inbox display-1 text-muted mb-3"></i>
                                            <h5 class="text-muted">Tidak ada buku ditemukan</h5>
                                            <p class="text-muted">Coba ubah filter pencarian Anda</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($books->count() > 0)
                <div class="card-footer bg-light">
                    <small class="text-muted">
                        <i class="bi bi-info-circle me-1"></i>
                        Menampilkan {{ $books->count() }} buku dengan rating tertinggi
                    </small>
                </div>
            @endif
        </div>
    </div>
</div>
{{-- auto load
<style>
.focused .form-control {
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    border-color: #86b7fe;
}

#search {
    padding-right: 50px; /* Make room for clear button */
}

.table tbody tr {
    transition: all 0.2s ease;
}

.table tbody tr:hover {
    background-color: rgba(13, 110, 253, 0.1);
    transform: translateX(5px);
}

/* Loading animation for table */
.table.loading {
    opacity: 0.6;
    pointer-events: none;
}

/* Add some spacing for better mobile experience */
@media (max-width: 768px) {
    .col-md-3, .col-md-6 {
        margin-bottom: 15px;
    }

    #search {
        padding-right: 45px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search');
    const listShowSelect = document.getElementById('list_show');
    const searchForm = searchInput.closest('form');
    const searchBtn = document.getElementById('search-btn');
    const loadingSpinner = document.getElementById('loading-spinner');

    let searchTimeout;

    // Function to show loading state
    function showLoading() {
        searchBtn.disabled = true;
        searchBtn.innerHTML = '<i class="bi bi-hourglass-split me-1"></i>Mencari...';
        loadingSpinner.style.display = 'inline-block';
    }

    // Function to hide loading state
    function hideLoading() {
        searchBtn.disabled = false;
        searchBtn.innerHTML = '<i class="bi bi-search me-1"></i>CARI';
        loadingSpinner.style.display = 'none';
    }

    // Auto-submit when dropdown selection changes
    listShowSelect.addEventListener('change', function() {
        showLoading();
        searchForm.submit();
    });

    // Auto-search as user types (with debounce)
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        showLoading();

        // Debounce search - wait 800ms after user stops typing
        searchTimeout = setTimeout(function() {
            searchForm.submit();
        }, 800);
    });

    // Handle form submission
    searchForm.addEventListener('submit', function() {
        showLoading();
    });

    // Hide loading when page loads
    window.addEventListener('load', function() {
        hideLoading();
    });

    // Optional: Clear search functionality
    const clearSearch = document.createElement('button');
    clearSearch.type = 'button';
    clearSearch.className = 'btn btn-outline-secondary';
    clearSearch.innerHTML = '<i class="bi bi-x-lg"></i>';
    clearSearch.title = 'Hapus pencarian';
    clearSearch.style.display = searchInput.value ? 'inline-block' : 'none';

    // Add clear button after search input
    searchInput.parentNode.style.position = 'relative';
    clearSearch.style.position = 'absolute';
    clearSearch.style.right = '10px';
    clearSearch.style.top = '50%';
    clearSearch.style.transform = 'translateY(-50%)';
    clearSearch.style.border = 'none';
    clearSearch.style.background = 'transparent';
    clearSearch.style.zIndex = '10';
    searchInput.parentNode.appendChild(clearSearch);

    // Show/hide clear button
    searchInput.addEventListener('input', function() {
        clearSearch.style.display = this.value ? 'inline-block' : 'none';
    });

    // Clear search functionality
    clearSearch.addEventListener('click', function() {
        searchInput.value = '';
        clearSearch.style.display = 'none';
        showLoading();
        searchForm.submit();
    });

    // Add visual feedback for search input
    searchInput.addEventListener('focus', function() {
        this.parentNode.classList.add('focused');
    });

    searchInput.addEventListener('blur', function() {
        this.parentNode.classList.remove('focused');
    });
});
</script> --}}
@endsection
