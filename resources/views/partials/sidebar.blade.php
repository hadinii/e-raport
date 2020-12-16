<?php
$currentUrl = url()->current();
?>

@if (Auth::user()->role == 'Admin')
    <nav class="pcoded-navbar">
        <div class="pcoded-inner-navbar main-menu">
            <div class="pcoded-navigatio-lavel"></div>
            <ul class="pcoded-item pcoded-left-item">
                <li class="{{ $currentUrl == route('dashboard') ? 'active pcoded-trigger' : '' }}">
                    <a href="{{ route('dashboard') }}">
                        <span class="pcoded-micon"><i class="feather icon-airplay"></i></span>
                        <span class="pcoded-mtext">Dashboard</span>
                    </a>
                </li>
            </ul>
            <div class="pcoded-navigatio-lavel">Data Master</div>
            <ul class="pcoded-item pcoded-left-item">
                <li class="">
                    <a href="{{ route('dashboard') }}">
                        <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                        <span class="pcoded-mtext">Data Sekolah</span>
                    </a>
                </li>
                <li class="">
                    <a href="{{ route('dashboard') }}">
                        <span class="pcoded-micon"><i class="feather icon-clipboard"></i></span>
                        <span class="pcoded-mtext">Data Kurikulum</span>
                    </a>
                </li>
                <li class="{{ $currentUrl == route('user.index') ? 'active pcoded-trigger' : '' }}">
                    <a href="{{ route('user.index') }}">
                        <span class="pcoded-micon"><i class="feather icon-user"></i></span>
                        <span class="pcoded-mtext">Data Guru</span>
                    </a>
                </li>
                <li class="{{ $currentUrl == route('siswa.index') ? 'active pcoded-trigger' : '' }}">
                    <a href="{{ route('siswa.index') }}">
                        <span class="pcoded-micon"><i class="feather icon-users"></i></span>
                        <span class="pcoded-mtext">Data Siswa</span>
                    </a>
                </li>
            </ul>
            <div class="pcoded-navigatio-lavel">Raport</div>
            <ul class="pcoded-item pcoded-left-item">
                <li class="{{ $currentUrl == route('tahun.index') ? 'active pcoded-trigger' : '' }}">
                    <a href="{{ route('tahun.index') }}">
                        <span class="pcoded-micon"><i class="feather icon-bookmark"></i></span>
                        <span class="pcoded-mtext">Data Tahun Ajaran</span>
                    </a>
                </li>
                <li class="{{ $currentUrl == route('kelas.index') ? 'active pcoded-trigger' : '' }}">
                    <a href="{{ route('kelas.index') }}">
                        <span class="pcoded-micon"><i class="feather icon-server"></i></span>
                        <span class="pcoded-mtext">Data Kelas</span>
                    </a>
                </li>
                <li class="">
                    <a href="{{ route('dashboard') }}">
                        <span class="pcoded-micon"><i class="feather icon-book"></i></span>
                        <span class="pcoded-mtext">Data Pelajaran</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
@else

@endif
