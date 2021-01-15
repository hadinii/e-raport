<?php
$title = 'Data Sekolah';
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
                            <span>Halaman data sekolah, digunakan untuk melihat, dan mengubah data sekolah. </span>
                        </div>
                    </div>
                </div>
                @include('partials.breadcrumb', ['breadcrumbs' => ['route.name' => 'Displayed Name']])
            </div>
        </div>
        <!-- Page Header end -->
        <!-- Page Body start -->
        <div class="page-body">
            <div class="row">
                <div class="col-12">
                    <!-- Zero config.table start -->
                    <div class="card">
                        <div class="card-header">
                        </div>
                        <div class="card-block">
                            <form action="{{ route('sekolah.update', $sekolah->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input id="nama" name="nama" type="text" class="form-control" value="{{ $sekolah->nama }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Alamat</label>
                                    <div class="col-sm-10">
                                        <textarea id="alamat" name="alamat" class="form-control" rows="5" readonly>{{ $sekolah->alamat }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Kepala Sekolah</label>
                                    <div class="col-sm-10">
                                        <input id="kepala_sekolah" name="kepala_sekolah" type="text" class="form-control" value="{{ $sekolah->kepala_sekolah }}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">NIP Kepala Sekolah</label>
                                    <div class="col-sm-10">
                                        <input id="nip_kepala_sekolah" name="nip_kepala_sekolah" type="text" class="form-control" value="{{ $sekolah->nip_kepala_sekolah }}" readonly>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-sm btn-inverse btn-edit float-right"> Edit</button>
                                <button type="submit" class="btn btn-sm btn-inverse btn-save float-right d-none"> Simpan</button>
                            </form>
                        </div>
                    </div>
                    <!-- Zero config.table end -->
                </div>
            </div>
        </div>
        <!-- Page Body end -->
    </div>
@endsection

@push('script')
    <!-- Max-length js -->
    <script type="text/javascript" src="{{ asset('adminty\files\bower_components\bootstrap-maxlength\js\bootstrap-maxlength.js') }}"></script>
    <!-- Date-dropper js -->
    <script type="text/javascript" src="{{ asset('adminty\files\bower_components\datedropper\js\datedropper.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            //
        });

        // btn edit
        $('.btn-edit').click(function() {
            $('#nama').attr('readonly', false);
            $('#alamat').attr('readonly', false);
            $('#kepala_sekolah').attr('readonly', false);
            $('#nip_kepala_sekolah').attr('readonly', false);
            $(this).addClass('d-none');
            $('.btn-save').removeClass('d-none');
        });

        // show success notification on success
        @if ($message = session('success'))
            const message = '{{ $message }}'
            notify('fas fa-check', 'success', message);
        @endif
    </script>
@endpush
