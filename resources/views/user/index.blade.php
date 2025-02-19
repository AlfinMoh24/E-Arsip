@extends('layouts.app')
@section('content')
    {{-- @dd($peminjamans)   --}}
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="fw-bold">Profile <span class="text-secondary"></span> <small class="text-secondary fw-normal fs-6">Peminjam
                <i class="fa-solid fa-caret-right"></i> &#128274; NIP : {{ auth()->user()->nip }}</small></h4>
    </div>
    <div class="row mt-3">
        <div class=" col-lg-9 col-sm-12 col-12">
            <div class="card shadow-sm mb-3">
                <div class="card-header bg-secondary text-white">Profile</div>
                <div class="card-body">
                    <span class="badge bg-dark">#Biodata Peminjam</span>
                    <h3 class="mt-3">{{ auth()->user()->name }}</h3>
                    <p class="text-muted">{{ auth()->user()->jabatan }}</p>
                    <hr>
                    <table class="table table-borderless fs-7">
                        <tr>
                            <th class="text-muted">NIP</th>
                            <td>{{ auth()->user()->nip }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">Nama</th>
                            <td>{{ auth()->user()->name }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">Jabatan</th>
                            <td>{{ auth()->user()->jabatan }}</td>
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
                <div class="modal-header d-flex justify-content-between">
                    <h6 class="modal-title">History Peminjaman</h6>
                    <button type="button" class=" rounded-1 btn text-secondary" data-bs-dismiss="modal"
                        aria-label="Close"><i class="fa-solid fa-circle-xmark"></i></button>
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
                                <th>Approval</th>
                                <th>
                                    &lt;/&gt;
                                </th>
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
                                    <td>{{ $peminjaman->tgl_pengembalian }}</td>
                                    <td>
                                        <span class="badge
                                            @if ($peminjaman->approval === 'pending') bg-primary
                                            @elseif ($peminjaman->approval === 'approved') bg-success
                                            @elseif ($peminjaman->approval === 'denied') bg-danger @endif">
                                            {{ ucfirst($peminjaman->approval) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if ($peminjaman->approval === 'approved')
                                            @if ($peminjaman->tgl_pengembalian === '-')
                                                <!-- Button Download (Aktif) -->
                                                <a href="{{ route('file.download.private', $peminjaman->file) }}" class="rounded-1 btn btn-success text-white px-2 py-1 fs-8">
                                                    <i class="fa-solid fa-download"></i>
                                                </a>
                                            @else
                                                <!-- Icon Checklist (Dokumen sudah dikembalikan) -->
                                                <div class="btn btn-outline-secondary fs-8 px-2 py-1 disabled">
                                                    <i class="fa-solid fa-check-circle text-success"></i>
                                                </div>
                                            @endif
                                        @else
                                            <!-- Button Disabled jika Approval bukan 'approved' -->
                                            <a href="#" class="rounded-1 btn btn-secondary text-white px-2 py-1 fs-8 disabled">
                                                <i class="fa-solid fa-download"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
