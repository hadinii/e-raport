<?php
$title = 'Tambah Kelas';
$showNav = true;
?>
@extends('layouts.adminty')

@section('title', $title)

@push('style')
    <!-- Multi Select css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('adminty\files\bower_components\bootstrap-multiselect\css\bootstrap-multiselect.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminty\files\bower_components\multiselect\css\multi-select.css') }}">
@endpush

@section('content')
    <div class="page-wrapper">
        <!-- Page Header start -->
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <div class="d-inline">
                            <h4>{{ $title }}</h4>
                            <span>Halaman Tambah Data Kelas</span>
                        </div>
                    </div>
                </div>
                @include('partials.breadcrumb', ['breadcrumbs' => ['kelas.index' => 'Data Kelas']])
            </div>
        </div>
        <!-- Page Header end -->
        <!-- Page Body start -->
        <div class="page-body">
            <form action="{{ route('kelas.store') }}" method="POST">
                @csrf
                <div class="col-12">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card h-100">
                                <div class="card-header">
                                    <h5>Detail Kelas</h5>
                                </div>
                                <div class="card-block">
                                    @if($errors->any())
                                        <div class="alert alert-warning background-warning">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <i class="icofont icofont-close-line-circled text-white"></i>
                                            </button>
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{$error}}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="form-group form-primary row">
                                        <label class="col-sm-3 col-form-label">Kelas</label>
                                        <div class="col-sm-3">
                                            <select name="tingkat_id" id="tingkat_id" class="form-control custom-select" required>
                                                <option value="1">I</option>
                                                <option value="2">II</option>
                                                <option value="3">III</option>
                                                <option value="4">IV</option>
                                                <option value="5">V</option>
                                                <option value="6">VI</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" id="nama" name="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="Nama Kelas" value="{{ old('nama') }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group form-primary row">
                                        <label class="col-sm-3 col-form-label">Wali Kelas</label>
                                        <div class="col-sm-9">
                                            <select id="wali_kelas_id" name="wali_kelas_id" class="form-control @error('wali_kelas_id') is-invalid @enderror" required>
                                                <option value="">Wali Kelas</option>
                                                @foreach ($guru as $row => $id)
                                                    <option value="{{ $id }}" {{ old('wali_kelas_id') == $id ? 'Selected' : '' }}>{{ $row }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <span class="form-bar"></span>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card h-100">
                                <div class="card-header">
                                    <h5>Pelajaran</h5>
                                </div>
                                <div class="card-block">
                                    <div class="col-sm-12 col-xl-4 m-b-30">
                                        <select multiple="multiple" id="pelajaran" name="pelajaran[]">
                                            @foreach ($pelajaran as $row)
                                            <option value="{{ $row->id }}">{{ $row->singkatan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-4">
                    <a href="{{ route('kelas.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary float-right">Simpan</button>
                </div>
            </form>
        </div>
        <!-- Page Body end -->
    </div>
@endsection

@push('script')
    <!-- Multiselect js -->
    <script type="text/javascript" src="{{ asset('adminty\files\bower_components\multiselect\js\jquery.multi-select.js') }}"></script>
    <script type="text/javascript" src="{{ asset('adminty\files\bower_components\bootstrap-multiselect\js\bootstrap-multiselect.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#pelajaran').multiSelect();;
        });
    </script>
@endpush
