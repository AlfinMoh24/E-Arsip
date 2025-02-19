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
                Form Add Dokumen
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

            <form action="{{ route('dokumen.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3 fs-9">
                    <label for="" class="col-sm-3 col-form-label text-end">Lokasi Penyimpanan</label>
                    <div class="col-sm-6">
                        <div class="row g-2">
                            <div class="col-2">
                                <label for="disabledTextInput" class="form-label" for="ruang">Ruang</label>
                                <select class="form-select fs-9" aria-label="Default select example" name="ruang_id">
                                    @foreach ($ruangs as $ruang)
                                        <option value="{{ $ruang->id }}"
                                            {{ old('ruang_id') == $ruang->id ? 'selected' : '' }}>
                                            {{ $ruang->ruang }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2">
                                <label for="disabledTextInput" class="form-label" for="rak">Rak</label>
                                <select class="form-select fs-9" aria-label="Default select example" name="rak_id">
                                    @foreach ($raks as $rak)
                                        <option value="{{ $rak->id }}"
                                            {{ old('rak_id') == $rak->id ? 'selected' : '' }}>
                                            {{ $rak->rak }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2">
                                <label for="disabledTextInput" class="form-label" for="map">Map</label>
                                <select class="form-select fs-9" aria-label="Default select example" name="map_id">
                                    @foreach ($maps as $map)
                                        <option value="{{ $map->id }}"
                                            {{ old('map_id') == $map->id ? 'selected' : '' }}>
                                            {{ $map->map }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2">
                                <label for="disabledTextInput" class="form-label" for="box">Box</label>
                                <select class="form-select fs-9" aria-label="Default select example" name="box_id">
                                    @foreach ($boxs as $box)
                                        <option value="{{ $box->id }}"
                                            {{ old('box_id') == $box->id ? 'selected' : '' }}>
                                            {{ $box->box }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2">
                                <label for="disabledTextInput" class="form-label" for="urut">Urut</label>
                                <select class="form-select fs-9" aria-label="Default select example" name="urut_id">
                                    @foreach ($uruts as $urut)
                                        <option value="{{ $urut->id }}"
                                            {{ old('urut_id') == $urut->id ? 'selected' : '' }}>
                                            {{ $urut->urut }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3 fs-9">
                    <label for="no_dok" class="col-sm-3 col-form-label text-end">Nomor Dokumen</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="no_dok" name="no_dok"
                            value="{{ old('no_dok') }}">
                    </div>
                </div>
                <div class="row mb-3 fs-9">
                    <label for="kode_dok" class="col-sm-3 col-form-label text-end">Kode Dokumen</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="kode_dok" name="kode_dok"
                            value="{{ old('kode_dok') }}">
                    </div>
                </div>
                <div class="row mb-3 fs-9">
                    <label for="nama_dok" class="col-sm-3 col-form-label text-end">Nama</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="nama_dok" name="nama_dok"
                            value="{{ old('nama_dok') }}">
                    </div>
                </div>
                <div class="row mb-3 fs-9">
                    <label for="deskripsi" class="col-sm-3 col-form-label text-end">Deskripsi</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="deskripsi" name="deskripsi"
                            value="{{ old('deskripsi') }}">
                    </div>
                </div>
                <div class="row mb-3 fs-9">
                    <label for="file" class="col-sm-3 col-form-label text-end">File</label>
                    <div class="col-sm-6">
                        <input type="file" class="form-control fs-8" id="file" name="file"
                            value="{{ old('file') }}">
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
