<?php
$title = 'Data Mata Pelajaran';
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
                            <span>Halaman data guru, digunakan untuk melihat, menambah, mengubah, dan menghapus data guru. </span>
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
                            {{-- // --}}
                        </div>
                        <div class="card-block">
                            <div class="dt-responsive table-responsive">
                                <table id="simpletable" class="table table-striped table-bordered nowrap">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Pelajaran</th>
                                        <th>Kelas</th>
                                        <th>Tahun Ajaran</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($jadwal as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $row->pelajaran->nama }}</td>
                                            <td>{{ $row->kelas->nama_lengkap }}</td>
                                            <td>{{ $row->kelas->tahun_ajaran->nama }}</td>
                                            <td>
                                                <label class="badge badge-{{ $row->kelas->tahun_ajaran->is_aktif ? 'success' : 'danger'}}">
                                                    {{ $row->kelas->tahun_ajaran->is_aktif ? 'Aktif' : 'Non-Aktif' }}
                                                </label>
                                            </td>
                                            <td>
                                                <a href="{{ route('kelas.show', $row) }}" class="btn btn-sm btn-inverse px-2" data-id="{{ $row->id }}" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Info">
                                                    <i class="feather icon-info mx-auto"></i>
                                                </a>
                                                @if ($row->kelas->tahun_ajaran->is_aktif)
                                                <button class="btn btn-sm btn-primary px-2" data-id="{{ $row->id }}" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Isi Nilai Raport">
                                                    <i class="feather icon-edit mx-auto"></i>
                                                </button>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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
    <!-- data-table js -->
    <script src="{{ asset('adminty\files\bower_components\datatables.net\js\jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminty\files\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js') }}"></script>
    <script>

        $(document).ready(function() {
            $('#simpletable').DataTable();
        });

        // show success notification on success
        @if ($message = session('success'))
            const message = '{{ $message }}'
            notify('fas fa-check', 'success', message);
        @endif
    </script>
@endpush
