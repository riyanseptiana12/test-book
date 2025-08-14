@extends('layouts.app')

@section('title', 'Top 10 Penulis Terpopuler - BookStore App')
@section('page-title', 'Top 10 Penulis Terpopuler')

@section('content')
<div class="row">
    <div class="col-12">

        <div class="card mb-4">
            <div class="card-body bg-warning bg-opacity-10">
                <div class="d-flex align-items-center">
                    <i class="bi bi-info-circle-fill text-warning fs-3 me-3"></i>
                    <div>
                        <h6 class="mb-1">Informasi Penting:</h6>
                        <p class="mb-0 text-muted">Daftar penulis berdasarkan jumlah vote dengan rating lebih dari 5</p>
                    </div>
                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-header text-center">
                <h4 class="mb-0">
                    <i class="bi bi-trophy-fill me-2"></i>Top 10 Penulis Terpopuler
                </h4>
                <p class="mb-0 mt-2 opacity-75">Diurutkan berdasarkan jumlah vote terbanyak</p>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th width="80" class="text-center">
                                    <i class="bi bi-award me-1"></i>Peringkat
                                </th>
                                <th>
                                    <i class="bi bi-person-fill me-1"></i>Nama Penulis
                                </th>
                                <th width="120" class="text-center">
                                    <i class="bi bi-people-fill me-1"></i>Jumlah Vote
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($authors as $index => $author)
                                <tr>
                                    <td class="text-center">
                                        @if($index == 0)
                                            <span class="badge bg-warning text-dark fs-6">
                                                <i class="bi bi-trophy-fill me-1"></i>1
                                            </span>
                                        @elseif($index == 1)
                                            <span class="badge bg-secondary fs-6">
                                                <i class="bi bi-award-fill me-1"></i>2
                                            </span>
                                        @elseif($index == 2)
                                            <span class="badge bg-danger fs-6">
                                                <i class="bi bi-award-fill me-1"></i>3
                                            </span>
                                        @else
                                            <span class="badge bg-primary rounded-pill">{{ $index + 1 }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar bg-primary text-white rounded-circle me-3 d-flex align-items-center justify-content-center"
                                                 style="width: 40px; height: 40px;">
                                                {{ substr($author->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <strong>{{ $author->name }}</strong>
                                                @if($index < 3)
                                                    <br><small class="text-muted">⭐ Penulis Terpopuler</small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-success fs-6">
                                            {{ number_format($author->voter_count) }} votes
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-5">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="bi bi-person-x display-1 text-muted mb-3"></i>
                                            <h5 class="text-muted">Belum ada penulis ditemukan</h5>
                                            <p class="text-muted">Belum ada rating yang memenuhi kriteria</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse


                            @if($authors->count() < 10)
                                @for($i = $authors->count(); $i < 10; $i++)
                                    <tr class="opacity-50">
                                        <td class="text-center">
                                            <span class="badge bg-light text-dark rounded-pill">{{ $i + 1 }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar bg-light text-muted rounded-circle me-3 d-flex align-items-center justify-content-center"
                                                     style="width: 40px; height: 40px;">
                                                    ?
                                                </div>
                                                <div>
                                                    <em class="text-muted">Slot kosong...</em>
                                                    @if($i == 9)
                                                        <br><small class="text-muted">voluptas</small>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-light text-muted">
                                                @if($i == 9) 5 @else 0 @endif votes
                                            </span>
                                        </td>
                                    </tr>
                                @endfor
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-light">
                <div class="row text-center">
                    <div class="col-md-4">
                        <small class="text-muted">
                            <i class="bi bi-funnel me-1"></i>Filter: Rating > 5
                        </small>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted">
                            <i class="bi bi-sort-down me-1"></i>Diurutkan berdasarkan vote terbanyak
                        </small>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted">
                            <i class="bi bi-people me-1"></i>Total Penulis: {{ $authors->count() }}/10
                        </small>
                    </div>
                </div>
            </div>
        </div>

        @if($authors->count() > 0)
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <i class="bi bi-trophy-fill text-warning display-4"></i>
                            <h5 class="mt-2">Penulis Terpopuler</h5>
                            <h3 class="text-primary">{{ $authors->first()->name }}</h3>
                            <p class="text-muted">{{ number_format($authors->first()->voter_count) }} votes</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <i class="bi bi-graph-up-arrow text-success display-4"></i>
                            <h5 class="mt-2">Total Vote</h5>
                            <h3 class="text-success">{{ number_format($authors->sum('voter_count')) }}</h3>
                            <p class="text-muted">dari semua penulis</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <i class="bi bi-people-fill text-info display-4"></i>
                            <h5 class="mt-2">Rata-rata Vote</h5>
                            <h3 class="text-info">{{ number_format($authors->avg('voter_count'), 1) }}</h3>
                            <p class="text-muted">per penulis</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
