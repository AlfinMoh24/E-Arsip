@extends('layouts.app')
@section('content')

    <style>
        .form-control {
            font-size: 13px
        }
    </style>
    <h4>Data <small class="fs-7">Dokumen <i class="fa-solid fa-caret-right me-1 fs-9"></i>insert</small></h4>
    <div class="card">
        <div class="card-header rounded-0 bg-black">
            <div class="ms-1 text-white fw-bold fs-9">
                Form Peminjaman
            </div>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger fs-8">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('peminjaman.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="file" value="{{$dokumen->file}}">
                <div class="row mb-3 fs-9">
                    <label for="no_dok" class="col-sm-3 col-form-label text-end">Nomor Dokumen</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" value="{{ $dokumen->no_dok }}"  disabled>
                        <input type="hidden" name="no_dok" value="{{ $dokumen->no_dok }}">
                    </div>
                </div>
                <div class="row mb-3 fs-9">
                    <label for="kode_dok" class="col-sm-3 col-form-label text-end">Kode Dokumen</label>
                    <div class="col-sm-6">

                        <input type="text" class="form-control" value="{{ $dokumen->kode_dok }}"  disabled>
                        <input type="hidden" name="kode_dok" value="{{ $dokumen->kode_dok }}">
                    </div>
                </div>
                <div class="row mb-3 fs-9">
                    <label for="nama_dok" class="col-sm-3 col-form-label text-end">Nama</label>
                    <div class="col-sm-6">

                        <input type="text" class="form-control" value="{{ $dokumen->nama_dok }}"  disabled>
                        <input type="hidden" name="nama_dok" value="{{ $dokumen->nama_dok }}">
                    </div>
                </div>
                <div class="row mb-3 fs-9">
                    <label for="tgl_ambil" class="col-sm-3 col-form-label text-end">Tanggal Ambil</label>
                    <div class="col-sm-6">
                        <div class="input-group date">
                            <input type="text" class="form-control" name='tgl_ambil'>
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                            <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="row mb-3 fs-9">
                    <label for="tgl_ambil" class="col-sm-3 col-form-label text-end">Tanggal Kembali</label>
                    <div class="col-sm-6">
                        <div class="input-group date sandbox-container">
                            <input type="text" class="form-control" name='tgl_kembali'>
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                            <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="row mb-3 fs-9">
                    <label class="col-sm-3"></label>
                    <div class="col-sm-6">
                        <button type="submit" class="btn btn-primary rounded-1"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
