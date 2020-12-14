<?php
$title = 'Tambah Siswa';
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
                            <h4>{{$title}}</h4>
                            <span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span>
                        </div>
                    </div>
                </div>
                @include('partials.breadcrumb', ['breadcrumbs' => ['siswa.index' => 'Data Siswa']])
            </div>
        </div>
        <!-- Page Header end -->
        <!-- Page Body start -->
        <div class="page-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            //
                        </div>
                        <div class="card-block">
                            <form id="form-create-edit" action="{{ route('user.store') }}" method="POST">
                                @csrf
                                <input id="method-form-create-edit" type="hidden" name="_method" value="">
                                <div class="modal-body">
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
                                    <div class="form-group form-primary">
                                        <input type="text" id="nama" name="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="Nama Lengkap" value="{{ old('nama') }}" required>
                                        <span class="form-bar"></span>
                                        <small class="text-muted">Nama lengkap</small>
                                    </div>
                                    <div class="form-group form-primary">
                                        <input type="number" min="0" maxlength="18" id="nisn" name="nisn" class="nisn form-control treshold-i @error('nisn') is-invalid @enderror" placeholder="NISN" value="{{ old('nisn') }}" required>
                                        <span class="form-bar"></span>
                                        <small class="text-muted">Terdiri dari 18 digit angka</small>
                                    </div>
                                    <div class="form-group form-primary">
                                        <input type="number" min="0" maxlength="18" id="nisn" name="nisn" class="nisn form-control treshold-i @error('nisn') is-invalid @enderror" placeholder="NISN" value="{{ old('nisn') }}" required>
                                        <span class="form-bar"></span>
                                        <small class="text-muted">Terdiri dari 18 digit angka</small>
                                    </div>
                                    <div class="j-unit">
                                        <label class="j-checkbox-toggle">
                                            <input type="checkbox" id="is_aktif" name="is_aktif" class="js-single" checked>
                                        </label>
                                    </div>
                                    <small class="">*: Password default untuk guru baru adalah angka 1-8</small>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light ">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Body end -->
    </div>
@endsection
