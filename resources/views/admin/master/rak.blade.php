@extends('layouts.app')
@section('content')
    <div class="d-flex align-items-center">
        <div class="me-auto">
            <h4>Master <small class="text-secondary fs-7">{{ $title }} Penyimpanan</small></h4>
        </div>
        <div class="py-3">
            @if (session()->has('success'))
                <button class=" rounded-1 btn bg-black text-white px-3 fs-8 me-3 btn-alert" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    <font color=orange><i class="fa-solid fa-bell me-2"></i></font> {{ session('success') }}
                </button>
            @endif
            <button class="rounded-1 btn btn-primary font-monospace fs-8" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fa-solid fa-circle-plus "></i> Add Rak
            </button>
        </div>
    </div>
    <div class="card shadow">
        <div class="card-header bg-black text-white rounded-0 ps-4">
            <small class="fs-8">
                <b>Result for "Data {{ $title }}"</b>
            </small>
        </div>
        <div class="card-body bg-white fs-8">
            <div class="p-">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th style="width:15px">No</th>
                                <th>Nama rak</th>
                                <th style="width: 60px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($raks as $rak)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $rak->rak }}</td>
                                    <td class="d-flex gap-1">
                                        <button type="button" class="rounded-1 btn btn-info text-white px-2 py-1 fs-8"
                                            data-bs-toggle="modal" data-bs-target="#idedit{{ $rak->id }}"
                                            data-toggle="tooltip" title="Edit"><i
                                                class="fa-solid fa-pencil  "></i></button>
                                        <button type="submit" class="rounded-1 btn btn-danger px-2 py-1 fs-8" data-bs-toggle="modal"
                                            data-bs-target="#id{{ $rak->id }}" data-toggle="tooltip" title="Delete"><i
                                                class="fa-solid fa-trash-can "></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        x-data="{ open: {{ session()->has('add_error') ? 'true' : 'false' }} }" x-init="if (open) { new bootstrap.Modal($el).show() }">

        <div class="modal-dialog">
            <div class="modal-content rounded-0">
                <div class="modal-header d-flex justify-content-between">
                    <h6 class="modal-title" id="exampleModalLabel">Tambah rak Penyimpanan</h6>
                    <button type="button" class=" rounded-1 btn text-secondary" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-circle-xmark"></i>
                    </button>
                </div>

                @if (session()->has('add_error'))
                    <div class="alert alert-danger invalid-modal">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('rak.store') }}" method="POST">
                    @csrf
                    <div class="modal-body fs-8 fw-bold">
                        <div class="mb-3 row align-items-center">
                            <label for="nip" class="col-sm-3 col-form-label text-end">Nama Rak</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="rak" id="rak">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class=" rounded-1 btn btn-primary"><i class="fa-solid fa-floppy-disk"></i>
                            Save</button>
                        <button type="button" class=" rounded-1 btn btn-light shadow-inner"data-bs-dismiss="modal"
                            aria-label="Close"><i class="fa-solid fa-rotate-left"></i> Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    @foreach ($raks as $rak)
        <div class="modal fade" id="idedit{{ $rak->id }}" tabindex="-1"
            aria-labelledby="editModalLabel{{ $rak->id }}" aria-hidden="true" x-data="{ open: {{ session('edit_id') == $rak->id ? 'true' : 'false' }} }"
            x-init="if (open) { new bootstrap.Modal($el).show() }">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header d-flex justify-content-between">
                        <h6 class="modal-title">Edit Rak Penyimpanan</h6>
                        <button type="button" class=" rounded-1 btn text-secondary" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa-solid fa-circle-xmark"></i>
                        </button>
                    </div>
                    <form method="POST" action="{{ route('rak.update', $rak->id) }}">
                        @csrf
                        @method('PUT')
                        @if (session('edit_id') == $rak->id && session()->has('edit_error'))
                            <div class="alert alert-danger invalid-modal">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="modal-body fs-8 fw-bold">
                            <div class="mb-3 row align-items-center">
                                <label for="nip" class="col-sm-3 col-form-label text-end">Nama Rak</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="rak" id="rak"
                                        value="{{ $rak->rak }}">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="rounded-1 btn btn-primary"><i class="fa-solid fa-floppy-disk"></i>
                                Save</button>
                            <button type="button" class="rounded-1 btn btn-light shadow-inner" data-bs-dismiss="modal"><i
                                    class="fa-solid fa-rotate-left"></i> Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal Delete -->
    @foreach ($raks as $rak)
        <div class="modal fade" id="id{{ $rak->id }}" tabindex="-1"
            aria-labelledby="deleteModalLabel{{ $rak->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header d-flex justify-content-between">
                        <h6 class="modal-title">Konfirmasi Hapus</h6>
                        <button type="button" class=" rounded-1 btn text-secondary" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa-solid fa-circle-xmark"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin menghapus Rak<b>{{ $rak->rak }}</b>?</p>
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('rak.destroy', $rak->id) }}" method="POST">
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
