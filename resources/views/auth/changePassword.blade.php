@extends('layouts.app')
@section('content')
    <style>
        .form-control {
            font-size: 13px
        }
    </style>
    <div class="d-flex justify-content-between">

        <h4>Password <small class="fs-7"> <i class="fa-solid fa-caret-right me-1 fs-9"></i>change</small></h4>
        <div class="py-3">
            @if (session()->has('success'))
                <button class=" rounded-1 btn bg-black text-white px-3 fs-8 me-3 btn-alert" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    <font color=orange><i class="fa-solid fa-bell me-2"></i></font> {{ session('success') }}
                </button>
            @endif
        </div>
    </div>
    <div class="card">
        <div class="card-header rounded-0 bg-black">
            <div class="ms-1 text-white fw-bold fs-9">
                Form Ganti Password
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('password.update') }}" method="POST">
                @method('PUT')
                @csrf

                <!-- Password Lama -->
                <div class="row mb-3 fs-9">
                    <label for="password_old" class="col-sm-3 col-form-label text-end">Password Lama</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control @error('password_old') is-invalid @enderror" id="password_old" name="password_old">
                        @error('password_old')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Password Baru -->
                <div class="row mb-3 fs-9">
                    <label for="password_new" class="col-sm-3 col-form-label text-end">Password Baru</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control @error('password_new') is-invalid @enderror" id="password_new" name="password_new">
                        @error('password_new')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Konfirmasi Password -->
                <div class="row mb-3 fs-9">
                    <label for="confirm_password" class="col-sm-3 col-form-label text-end">Konfirmasi Password</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control @error('confirm_password') is-invalid @enderror" id="confirm_password" name="confirm_password">
                        @error('confirm_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Tombol Submit -->
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
