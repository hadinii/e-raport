<?php
$title = 'Kelas '.$kelas->nama_lengkap;
$showNav = true;
?>
@extends('layouts.adminty')

@section('title', $title)

@section('content')
    <div class="page-wrapper">
        <!-- Page Header start -->
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <div class="d-inline">
                            <h4>{{ $title }}</h4>
                            <span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span>
                        </div>
                    </div>
                </div>
                @include('partials.breadcrumb', ['breadcrumbs' => ['kelas.index' => 'Data Kelas']])
            </div>
        </div>
        <!-- Page Header end -->
        <!-- Page Body start -->
        <div class="page-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Detail Kelas</h5>
                        </div>
                        <div class="card-block">
                            <div class="col-12 row">
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Nama Kelas</label>
                                        <label class="col-sm-9 col-form-label">: <strong> {{ $kelas->nama_lengkap }} </strong> </label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Tahun Ajaran</label>
                                        <label class="col-sm-9 col-form-label">: <strong> {{ $tahun_ajaran->nama }} </strong> </label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Wali Kelas</label>
                                        <label class="col-sm-9 col-form-label">: <strong> {{ $kelas->wali_kelas->nama }} </strong> </label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Jumlah Mapel</label>
                                        <label class="col-sm-9 col-form-label">: <strong> {{ $kelas->jumlah_mapel }} </strong> </label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Jumlah Siswa</label>
                                        <label class="col-sm-9 col-form-label">: <strong> {{ $kelas->jumlah_siswa }} </strong> </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Anggota Kelas</h5>
                                </div>
                                <div class="card-block">
                                    asdaspdk
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Pelajaran</h5>
                                </div>
                                <div class="card-block">
                                    @foreach ($pelajaran as $row)
                                        <div class="alert alert-primary border-default mb-3">
                                            <p class="text-dark">
                                                <strong>{{ $row->pelajaran->nama }}</strong> ( {{ $row->pelajaran->singkatan }} )
                                            </p>
                                            <p class="text-muted">{{ optional($row->guru)->nama ?? 'Belom ada' }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Body end -->
    </div>
@endsection
