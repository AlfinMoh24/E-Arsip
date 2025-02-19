@extends('layouts.app')
@section('content')
    <div class="d-flex align-items-center">
        <div class="me-auto">
            <h5><i class="fa-solid fa-peminjaman me-2"></i>{{ $title }}</h5>
        </div>
        <div class="py-3">
            @if (session()->has('successTransaksi'))
                <button class="rounded-1 btn bg-black text-white px-3 fs-8 me-3 btn-alert" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    <font color=orange><i class="fa-solid fa-bell me-2"></i></font> {{ session('successTransaksi') }}
                </button>
            @endif
        </div>
    </div>
    <div class="card shadow mt-4">
        <div class="card-header bg-black text-white rounded-0 ps-4">
            <small class="fs-8">
                <b>Result for "Data Peminjaman"</b>
            </small>
        </div>
        <div class="card-body bg-white fs-8 p-4">
            <div class="p-">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th style="width:15px">No</th>
                                <th>No. Dok</th>
                                <th>Nama Dokumen</th>
                                <th>Tgl. ambil</th>
                                <th>Tgl. kembali</th>
                                <th>Peminjam</th>
                                <th>Tgl. Pengembalian</th>
                                <th>Approval</th>
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
                                    <td>{{ $peminjaman->user->name }}</td>
                                    <td>{{ $peminjaman->tgl_pengembalian }}</td>
                                    <td>
                                        <span
                                            class="badge
                                            @if ($peminjaman->approval === 'pending') bg-primary
                                            @elseif ($peminjaman->approval === 'approved') bg-success
                                            @elseif ($peminjaman->approval === 'denied') bg-danger @endif">
                                            {{ ucfirst($peminjaman->approval) }}
                                        </span>
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
