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
                                <th>tgl_ambil</th>
                                <th>tgl_kembali</th>
                                <th>Peminjam</th>
                                <th>Action</th>
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
                                    <td style="width:10px">
                                        <a data-bs-toggle="modal" data-bs-target="#approval-{{ $peminjaman->id }}" class="rounded-1 btn text-white px-2 py-1 fs-8" style="background: #20c997">
                                            <i class="fa-solid fa-share"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
     <!-- Modal Edit -->
     @foreach ($peminjamans as $peminjaman)
     <div class="modal fade" id="approval-{{ $peminjaman->id }}" tabindex="-1"
         aria-labelledby="editModalLabel{{ $peminjaman->id }}" aria-hidden="true">
         <div class="modal-dialog">
             <div class="modal-content rounded-1">
                 <div class="modal-header  d-flex justify-content-between">
                     <h6 class="modal-title fs-7"><small class="badge bg-dark fs-9 fw-normal rounded-1">#Pengembalian</small> {{$peminjaman->nama_dok}}</span>?</h6>
                     <button type="button" class=" rounded-1 btn text-secondary" data-bs-dismiss="modal"
                        aria-label="Close"><i class="fa-solid fa-circle-xmark"></i></button>
                 </div>
                 <form method="POST" action="{{ route('pengembalian.update', $peminjaman->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="modal-body fs-8 text-center">
                        <small>Pastikan data pinjaman tervalidasi dan sesuai. Klik <b>Ok</b> untuk melakukan pengembalian pinjaman !</small><br>
                        <button type="submit" class="mt-2 rounded-1 btn btn-danger px-4 me-1">
                            Ok
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="rounded-0 btn btn-outline-secondary text-black fs-9" data-bs-dismiss="modal"
                            aria-label="Close">Cancel</button>
                    </div>
                </form>

             </div>
         </div>
     </div>
 @endforeach
@endsection
