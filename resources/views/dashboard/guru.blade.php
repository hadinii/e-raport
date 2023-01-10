<?php
$title = 'Dashboard';
$showNav = true;
$user = Auth::user();
?>
@extends('layouts.adminty')

@section('title', $title)

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="col-12">
                <div class="row">
                    <!-- wather user -->
                    <div class="col-xl-6 col-md-12">
                        <div class="card user-card-full">
                            <div class="row m-l-0 m-r-0">
                                <div class="col-sm-5 bg-c-lite-green user-profile">
                                    <div class="card-block text-center text-white">
                                        <div class="m-b-25">
                                            <img src="{{ asset('adminty\files\assets\images\avatar-4.jpg') }}" class="img-radius" alt="User-Profile-Image">
                                        </div>
                                        <h6 class="f-w-600">{{ $user->nama }}</h6>
                                        <p>{{ $user->nip }}</p>
                                        {{-- <i class="feather icon-edit m-t-10 f-16"></i> --}}
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="card-block">
                                        <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Wali Kelas</h6>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                @if ($waliKelas)
                                                <p class="m-b-10 f-w-600">Kelas {{$waliKelas->nama_lengkap ?? '-'}}</p>
                                                @else
                                                <h6 class="text-muted f-w-400">Tidak menjadi wali kelas</h6>
                                                @endif
                                            </div>
                                        </div>
                                        <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Mata Pelajaran</h6>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                @if (count($jadwal) > 0)
                                                @foreach ($jadwal->unique('pelajaran_id') as $row)
                                                <p class="m-b-10 f-w-600">{{$row->pelajaran->nama}}</p>
                                                @endforeach
                                                @else
                                                <h6 class="text-muted f-w-400">Tidak mengajar</h6>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- wather user -->
                    <!-- task, page, download counter  start -->
                    <div class="col-xl-6 col-md-12 row">
                        <div class="col-xl-6 col-md-6">
                            <div class="card bg-c-lite-green update-card">
                                <div class="card-block">
                                    <div class="row align-items-end">
                                        <div class="col-9">
                                            <h4 class="text-white">{{ $semester->tahun_aktif ?? '-' }}</h4>
                                            <h6 class="text-white m-b-0">{{$semester->semester ?? '-'}}</h6>
                                        </div>
                                        <div class="col-3 text-right">
                                            <canvas id="update-chart-4" height="50"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <p class="text-white m-b-0"><i class="feather icon-award text-white f-14 m-r-10"></i>Semester Aktif</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6">
                            <div class="card bg-c-yellow update-card">
                                <div class="card-block">
                                    <div class="row align-items-end">
                                        <div class="col-8">
                                            <h4 class="text-white">{{ count($jadwal) ? $jadwal->unique('pelajaran_id')->count() : '0'}}</h4>
                                            <h6 class="text-white m-b-0">Pelajaran</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <canvas id="update-chart-1" height="50"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>Jumlah mengajar pelajaran</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6">
                            <div class="card bg-c-green update-card">
                                <div class="card-block">
                                    <div class="row align-items-end">
                                        <div class="col-8">
                                            <h4 class="text-white">{{ count($jadwal) ? $jadwal->sum('kelas.jumlah_siswa') : '0'}}</h4>
                                            <h6 class="text-white m-b-0">Siswa</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <canvas id="update-chart-2" height="50"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>Jumlah Siswa Kelas</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6">
                            <div class="card bg-c-pink update-card">
                                <div class="card-block">
                                    <div class="row align-items-end">
                                        <div class="col-8">
                                            <h4 class="text-white">{{ count($jadwal) ? $jadwal->count() : '0' }}</h4>
                                            <h6 class="text-white m-b-0">Kelas</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <canvas id="update-chart-3" height="50"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>Jumlah Kelas Mengajar</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- task, page, download counter  end -->

                </div>
            </div>
        </div>
    </div>
@endsection
