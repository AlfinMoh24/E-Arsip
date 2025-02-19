@extends('layouts.app')
@section('content')
    <div class="d-flex align-items-center">
        <div class="me-auto">
            <h5><i class="fa-solid fa-dokumen me-2"></i>{{ $title }}</h5>
        </div>
        @can('admin')
            <div class="py-3">
                @if (session()->has('successDokumen'))
                    <button class="rounded-1 btn bg-black text-white px-3 fs-8 me-3 btn-alert" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        <font color=orange><i class="fa-solid fa-bell me-2"></i></font> {{ session('successDokumen') }}
                    </button>
                @endif
                <a href="{{ route('dokumen.export') }}" class="rounded-1 btn btn-success font-monospace fs-8">
                    <i class="fa-solid fa-file-excel"></i> Export
                </a>
                <a href="{{ route('dokumen.create') }}" class="rounded-1 btn btn-primary font-monospace fs-8">
                    <i class="fa-solid fa-circle-plus "></i> Add Dokumen
                </a>
            </div>
        @endcan
    </div>
    <div class="card shadow">
        <div class="card-header bg-black text-white rounded-0 ps-4">
            <small class="fs-8">
                <b>Result for "Data {{ $title }}"</b>
            </small>
        </div>
        <div class="card-body bg-white fs-8 p-4">
            <div class="p-">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th style="width:15px">No</th>
                                <th>Lokasi</th>
                                <th>Nomor Dokumen</th>
                                <th>Nama Dokumen</th>
                                <th>Nama Size (KB)</th>
                                <th>Tgl Upload</th>
                                @auth
                                    <th>Action</th>
                                @endauth
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dokumens as $dokumen)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ ($dokumen->rak->rak ?? '') .
                                        '.' .
                                        ($dokumen->ruang->ruang ?? '') .
                                        '.' .
                                        ($dokumen->box->box ?? '') .
                                        '.' .
                                        ($dokumen->map->map ?? '') .
                                        '.' .
                                        ($dokumen->urut->urut ?? '') }}
                                    </td>
                                    <td>
                                        <a href="" data-bs-toggle="modal" data-bs-target="#idshow{{ $dokumen->id }}"
                                            class="fw-bold">
                                            {{ $dokumen->no_dok }}
                                        </a>
                                    </td>
                                    <td>{{ $dokumen->nama_dok }}</td>
                                    <td>{{ $dokumen->ukuran . ' KB' }}</td>
                                    <td>{{ $dokumen->created_at->format('Y-m-d') }}</td>
                                    @can('user')
                                        <td style="width:10px">
                                            <a href="{{ route('peminjaman.create', $dokumen->id) }}"
                                                class="rounded-1 btn btn-success text-white px-2 py-1 fs-8">
                                                <i class="fa-solid fa-solid fa-paper-plane"></i>
                                            </a>
                                        </td>
                                    @endcan
                                    @can('admin')
                                        <td class="d-flex gap-1">
                                            <a href="{{ route('file.download.private', $dokumen->file) }}"
                                                class="rounded-1 btn btn-success text-white px-2 py-1 fs-8">
                                                <i class="fa-solid fa-download"></i>
                                            </a>
                                            <a href="{{ route('dokumen.edit', $dokumen->id) }}"
                                                class="rounded-1 btn btn-warning text-white px-2 py-1 fs-8">
                                                <i class="fa-solid fa-pencil"></i>
                                            </a>
                                            <button type="submit" class="rounded-1 btn btn-danger px-2 py-1 fs-8"
                                                data-bs-toggle="modal" data-bs-target="#id{{ $dokumen->id }}"
                                                data-toggle="tooltip" title="Delete"><i
                                                    class="fa-solid fa-trash-can "></i></button>
                                        </td>
                                    @endcan
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    @foreach ($dokumens as $dokumen)
        <div class="modal fade" id="idshow{{ $dokumen->id }}" tabindex="-1"
            aria-labelledby="editModalLabel{{ $dokumen->id }}" aria-hidden="true">

            <div class="modal-dialog modal-md fs-8">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fs-8">
                            <i class="bi bi-folder "></i> Detail Dokumen No. <strong>RER2017-01/GD</strong>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-5">
                        <div class="d-flex">
                            <small class="fw-bold col-5 mb-3">Nomor Dokumen</small>
                            <small>{{ $dokumen->no_dok }}</small>
                        </div>
                        <div class="d-flex">
                            <small class="fw-bold col-5 mb-3">Kode Dokumen</small>
                            <small>{{ $dokumen->kode_dok }}</small>
                        </div>
                        <div class="d-flex">
                            <small class="fw-bold col-5 mb-3">Nama</small>
                            <small>{{ $dokumen->nama_dok }}</small>
                        </div>
                        <div class="d-flex">
                            <small class="fw-bold col-5 mb-3">Deskripsi</small>
                            <small>{{ $dokumen->deskripsi }}</small>
                        </div>
                        <div class="d-flex">
                            <small class="fw-bold col-5 mb-3">Nama file</small>
                            <small>{{ $dokumen->file }}</small>
                        </div>
                        <div class="d-flex">
                            <small class="fw-bold col-5 mb-3">Ukuruan</small>
                            <small>{{ $dokumen->ukuran . ' KB' }}</small>
                        </div>
                        <div class="d-flex">
                            <small class="fw-bold col-5 mb-3">Tanggal Upload</small>
                            <small>{{ $dokumen->created_at->format('Y-m-d') }}</small>
                        </div>


                        <hr>

                        <div class="d-flex">
                            <small class="fw-bold col-5 mb-3">Lokasi Penyimpanan</small>
                            <div class="row gap-3">
                                <small>Ruang : {{ $dokumen->ruang->ruang }}</small>
                                <small>Rak : {{ $dokumen->rak->rak }}</small>
                                <small>Bok : {{ $dokumen->box->box }}</small>
                                <small>Map : {{ $dokumen->map->map }}</small>
                                <small>Urut : {{ $dokumen->urut->urut }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal Delete -->
    @foreach ($dokumens as $dokumen)
        <div class="modal fade" id="id{{ $dokumen->id }}" tabindex="-1"
            aria-labelledby="deleteModalLabel{{ $dokumen->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h6 class="modal-title">Konfirmasi Hapus</h6>
                        <button type="button" class="rounded-1 btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin menghapus Dokumen <b>{{ $dokumen->nama_dok }}</b>?</p>
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('dokumen.destroy', $dokumen->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="rounded-1 btn btn-danger"><i class="fa-solid fa-trash-can"></i>
                                Hapus</button>
                        </form>
                        <button type="button" class="rounded-1 btn btn-light shadow-inner" data-bs-dismiss="modal"><i
                                class="fa-solid fa-rotate-left"></i> Batal</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
