<div class="sidebar" id="sidebar">
    <div class="row no-gutters  h-100">
        <div class="col bg-dark">
            <div class="row text-white">
                @auth
                    <div class="data pt-2 d-flex bg-black align-items-center pb-2">
                            <img src="{{ url('/private-image/' . 'admin1.png') }}">
                        <div class="">
                            <small>{{ auth()->user()->nip }}</small>
                            <br>
                            <small class="text-secondary">{{ auth()->user()->level }}</small>
                        </div>
                    </div>
                @endauth
            </div>

            <ul class="nav flex-column mt-3">
                @if (Auth::guest() || auth()->user()->level !== 'admin')
                <li class="nav-item">
                    <div class="ms-3" style="margin-bottom:12px;text-decoration:none; color:#C0BFBF;font-size:12px;" aria-current="page" href="index.php" style="margin-top:15px">Navigation &nbsp;&nbsp;<i class="fa-solid fa-paper-plane fa-xs"></i></div>
                  </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/"><i
                            class="icon-dashboard me-3"></i>Dashboard
                    </a>
                </li>
                @can('admin')
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#collapse1" aria-expanded="false"
                            aria-controls="collapse1">
                            <i class="fas fa-solid fa-gear me-3"></i> Master Setup <i
                                class="fa-solid fa-caret-down ms-2"></i> </a>
                        </a>
                    </li>
                    <div class="collapse" id="collapse1">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link sub-menu ms-2 ps-5 p-1" href="/admin/ruang"><i
                                        class="fa-solid fa-caret-right me-2"></i>Ruang</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link sub-menu ms-2 ps-5 p-1" href="/admin/rak"><i
                                        class="fa-solid fa-caret-right me-2"></i>Rak</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link sub-menu ms-2 ps-5 p-1" href="/admin/box"><i
                                        class="fa-solid fa-caret-right me-2"></i>Box</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link sub-menu ms-2 ps-5 p-1" href="/admin/map"><i
                                        class="fa-solid fa-caret-right me-2"></i>Map</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link sub-menu ms-2 ps-5 p-1" href="/admin/urut"><i
                                        class="fa-solid fa-caret-right me-2"></i>Urut</a>
                            </li>
                        </ul>
                    </div>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user-peminjam.index') }}"><i class="fa-solid fa-user me-3"></i>User
                            Peminjam</a>
                    </li>
                @endcan
                <li class="nav-item">
                    <a class="nav-link" href="{{route('dokumen.index')}}"><i class="fa-solid fa-folder-closed me-3"></i>
                        Document</a>
                </li>
                @can('admin')
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#collapse2" aria-expanded="false"
                            aria-controls="collapse2">
                            <i class="fas fa-solid fa-gear me-3"></i> Transaksi <i class="fa-solid fa-caret-down ms-2"></i>
                        </a>
                        </a>
                    </li>
                    <div class="collapse" id="collapse2">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="{{route('approval')}}" class="nav-link sub-menu ms-2 ps-5 p-1"><i
                                        class="fa-solid fa-caret-right me-2"></i>Approval</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link sub-menu ms-2 ps-5 p-1" href="{{route('pengembalian')}}"><i
                                        class="fa-solid fa-caret-right me-2"></i>Pengembalian</a>
                            </li>
                        </ul>
                    </div>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#collapse3" aria-expanded="false"
                            aria-controls="collapse3">
                            <i class="fas fa-solid fa-gear me-3"></i> Report <i class="fa-solid fa-caret-down ms-2"></i>
                        </a>
                        </a>
                    </li>
                    <div class="collapse" id="collapse3">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link sub-menu ms-2 ps-5 p-1" href="{{route('peminjaman')}}"><i
                                        class="fa-solid fa-caret-right me-2"></i>Peminjaman</a>
                            </li>
                        </ul>
                    </div>
                @endcan

                @auth
                    <ul class="profil-mobile">
                        <hr class="border border-light border-1">
                        <li><a class="text-light" href="#"><small><i
                                        class="fa-sharp fa-solid fa-unlock-keyhole me-2"></i>
                                    Change Password</small></a>
                        </li>
                        <li><a class="text-light" href="#"><small><i
                                        class="fa-solid fa-right-from-bracket me-2"></i>Logout</small></a></li>
                    </ul>
                @endauth
                @guest
                    <ul class="profil-mobile">
                        <hr class="border border-light border-1">
                        <li><a class="text-light" href="{{ route('login') }}"><small><i
                                        class="fa-solid fa-arrow-right-from-bracket "></i>
                                    Login</small></a>
                        </li>
                    </ul>
                @endguest
            </ul>
        </div>
    </div>
</div>

<div class="overlay" id="overlay">

</div>
