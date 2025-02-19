@extends('layouts.app')
@section('content')
    <div class="d-flex align-items-center">
        <div class="me-auto">
            <h5><i class="fa-solid fa-user me-2"></i>{{ $title }}</h5>
        </div>
        <div class="py-3">
            @if (session()->has('success'))
                <button class=" rounded-1 btn bg-black text-white px-3 fs-8 me-3 btn-alert" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    <font color=orange><i class="fa-solid fa-bell me-2"></i></font> {{ session('success') }}
                </button>
            @endif
            <button class=" rounded-1 btn btn-success font-monospace fs-8" data-bs-toggle="modal"
                data-bs-target="#exampleModal">
                <i class="fa-solid fa-file-excel"></i> Export
            </button>
            <button class=" rounded-1 btn btn-primary font-monospace fs-8" data-bs-toggle="modal"
                data-bs-target="#exampleModal">
                <i class="fa-solid fa-circle-plus "></i> Add Peminjam
            </button>
        </div>
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
                                <th>Nip</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th style="width: 60px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a href="/admin/user-peminjam/{{ $user->nip }}" class="fw-bold">
                                            {{ $user->nip }}
                                        </a>
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->jabatan }}</td>
                                    <td class="d-flex gap-1">
                                        <a href="/admin/user-peminjam/{{ $user->nip }}"
                                            class=" rounded-1 btn btn-info text-white px-2 py-1 fs-8"><i
                                                class="fa-solid fa-eye"></i></i></a>
                                        <button type="button" class=" rounded-1 btn btn-warning text-white px-2 py-1 fs-8"
                                            data-bs-toggle="modal" data-bs-target="#idedit{{ $user->id }}"
                                            data-toggle="tooltip"><i class="fa-solid fa-pencil  "></i></button>
                                        <button type="submit" class=" rounded-1 btn btn-danger px-2 py-1 fs-8"
                                            data-bs-toggle="modal" data-bs-target="#id{{ $user->id }}"
                                            data-toggle="tooltip" title="Delete"><i
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
                    <h6 class="modal-title" id="exampleModalLabel">Tambah User Peminjam</h6>
                    <button type="button" class=" rounded-1 btn text-secondary" data-bs-dismiss="modal"
                        aria-label="Close"><i class="fa-solid fa-circle-xmark"></i></button>
                </div>
                <form action="{{ route('user-peminjam.store') }}" method="POST">
                    @csrf
                    @if (session()->has('add_error'))
                        <div class="alert alert-danger invalid-modal">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="text-center mt-2 fs-8">
                        <i class="fa-solid fa-triangle-exclamation text-warning"></i> Peringatan: Password default untuk user peminjam adalah 123. Harap segera mengubahnya setelah login pertama.
                    </div>
                    <div class="modal-body fs-8 fw-bold">
                        <div class="mb-3 row align-items-center">
                            <label for="nip" class="col-sm-4 col-form-label text-end">NIP</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="nip" name="nip">
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="namaPeminjam" class="col-sm-4 col-form-label text-end">Nama Peminjam</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="namaPeminjam" name="name">
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="jabatan" class="col-sm-4 col-form-label text-end">Jabatan</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="jabatan" name="jabatan">
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
    </div>

    <!-- Modal Edit -->
    @foreach ($users as $user)
        <div class="modal fade" id="idedit{{ $user->id }}" tabindex="-1"
            aria-labelledby="editModalLabel{{ $user->id }}" aria-hidden="true" x-data="{ open: {{ session('edit_id') == $user->id ? 'true' : 'false' }} }"
            x-init="if (open) { new bootstrap.Modal($el).show() }">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header d-flex justify-content-between">
                        <h6 class="modal-title">Edit User Peminjam</h6>
                        <button type="button" class=" rounded-1 btn text-secondary" data-bs-dismiss="modal"
                        aria-label="Close"><i class="fa-solid fa-circle-xmark"></i></button>
                    </div>
                    <form method="POST" action="{{ route('user-peminjam.update', $user->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="modal-body fs-8 fw-bold">
                            @if (session('edit_id') == $user->id && session()->has('edit_error'))
                                <div class="alert alert-danger invalid-modal">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="mb-3 row align-items-center">
                                <label for="nip" class="col-sm-4 col-form-label text-end">NIP</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="nip" name="nip"
                                        value="{{ $user->nip }}">
                                </div>
                            </div>
                            <div class="mb-3 row align-items-center">
                                <label for="namaPeminjam" class="col-sm-4 col-form-label text-end">Nama Peminjam</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="namaPeminjam" name="name"
                                        value="{{ $user->name }}">
                                </div>
                            </div>
                            <div class="mb-3 row align-items-center">
                                <label for="jabatan" class="col-sm-4 col-form-label text-end">Jabatan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="jabatan" name="jabatan"
                                        value="{{ $user->jabatan }}">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class=" rounded-1 btn btn-primary"><i
                                    class="fa-solid fa-floppy-disk"></i>
                                Save</button>
                            <button type="button" class=" rounded-1 btn btn-light shadow-inner"data-bs-dismiss="modal"
                                aria-label="Close"><i class="fa-solid fa-rotate-left"></i> Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal Delete -->
    @foreach ($users as $user)
        <div class="modal fade" id="id{{ $user->id }}" tabindex="-1"
            aria-labelledby="deleteModalLabel{{ $user->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header d-flex justify-content-between">
                        <h6 class="modal-title">Konfirmasi Hapus</h6>
                        <button type="button" class=" rounded-1 btn text-secondary" data-bs-dismiss="modal"
                        aria-label="Close"><i class="fa-solid fa-circle-xmark"></i></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin menghapus user <b>{{ $user->name }}</b>?</p>
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('user-peminjam.destroy', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class=" rounded-1 btn btn-danger"><i
                                    class="fa-solid fa-trash-can"></i>
                                Hapus</button>
                        </form>
                        <button type="button" class=" rounded-1 btn btn-light shadow-inner" data-bs-dismiss="modal"><i
                                class="fa-solid fa-rotate-left"></i> Batal</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
