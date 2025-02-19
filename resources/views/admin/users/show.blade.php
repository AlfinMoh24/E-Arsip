@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="fw-bold">Profile <span class="text-secondary"></span> <small class="text-secondary fw-normal fs-6">Peminjam
                <i class="fa-solid fa-caret-right"></i> &#128274; NIP : {{ $user->nip }}</small></h4>
        <button class="btn btn-light border fs-7 rounded-0">&#9666; Back</button>
    </div>
    <div class="row mt-3">
        <div class=" col-lg-9 col-sm-12 col-12">
            <div class="card shadow-sm mb-3">
                <div class="card-header bg-secondary text-white">Profile</div>
                <div class="card-body">
                    <span class="badge bg-dark">#Biodata Peminjam</span>
                    <h3 class="mt-3">{{ $user->name }}</h3>
                    <p class="text-muted">{{ $user->jabatan }}</p>
                    <hr>
                    <table class="table table-borderless fs-7">
                        <tr>
                            <th class="text-muted">NIP</th>
                            <td>{{ $user->nip }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">Nama</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">Jabatan</th>
                            <td>{{ $user->jabatan }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-12 col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-dark fs-8 fw-semibold text-white">
                    <i class="bi bi-hourglass-split text-warning me-3 fs-9"></i> Histori Peminjaman
                </div>
                <div class="card-body text-end">
                    <button class="btn btn-outline-dark fs-8 rounded-0" data-bs-toggle="modal"
                        data-bs-target="#openModal"><i class="fa-solid fa-calendar-days me-2"></i>
                        History</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="openModal" tabindex="-1" aria-labelledby="editModalLabelopenModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Edit peminjaman Peminjam</h6>
                    <button type="button" class=" rounded-1 btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body fs-8">
                    <table class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th style="width:15px">No</th>
                                <th>No Dok</th>
                                <th>Nama Dokumen</th>
                                <th>Tgl Ambil</th>
                                <th>Tgl Kembali</th>
                                <th>Tgl Pengembalian</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($peminjamans as $peminjaman)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $peminjaman->no_dok }}</td>
                                    <td>{{ $peminjaman->nama_dok }}</td>
                                    <td>{{ $peminjaman->tgl_ambil }}</td>
                                    <td>{{ $peminjaman->tgl_kembali }}</td>
                                    <td>{{ $peminjaman->created_at->format('Y-m-d') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class=" rounded-1 btn btn-light shadow-inner"data-bs-dismiss="modal"
                        aria-label="Close"><i class="fa-solid fa-rotate-left"></i> Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endsection
