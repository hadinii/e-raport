<?php
$title = 'Kelas '.$kelas->nama_lengkap;
$showNav = true;
$role = Auth::user()->role;
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
                @include('partials.breadcrumb', ['breadcrumbs' => [ 'user.jadwal' => 'Data Mata Pelajaran' ]])
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
                                        <label class="col-sm-3 col-form-label">Mata Pelajaran</label>
                                        <label class="col-sm-9 col-form-label">: <strong> {{ $pelajaran->nama }} </strong> </label>
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
                    <div class="card">
                        <div class="card-header">
                            <h5>Siswa Kelas</h5>
                        </div>
                        <div class="card-block">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="example-2">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama</th>
                                            <th>Nilai Pengetahuan</th>
                                            <th>Deskripsi Pengetahuan</th>
                                            <th>Nilai Keterampilan</th>
                                            <th>Deskripsi Keterampilan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($nilai as $row)
                                        <tr>
                                            <th scope="row"><span class="tabledit-span">{{ $loop->iteration }}</span>
                                                <input class="tabledit-input form-control input-sm" type="hidden" name="id" value="{{ trim($row->id) }}">
                                            </th>
                                            <td>{{ $row->raport->nama_siswa }}</td>
                                            <td class="tabledit-view-mode"><span class="tabledit-span">{{ $row->nilai_pengetahuan }}</span>
                                                @if ($tahun_ajaran->is_aktif)
                                                <input class="tabledit-input form-control input-sm" type="text" name="nilai_pengetahuan" value="{{ trim($row->nilai_pengetahuan) }}">
                                                @endif
                                            </td>
                                            <td class="tabledit-view-mode"><span class="tabledit-span">{{ $row->deskripsi_pengetahuan }}</span>
                                                @if ($tahun_ajaran->is_aktif)
                                                <input class="tabledit-input form-control input-sm" type="text" name="deskripsi_pengetahuan" value="{{ trim($row->deskripsi_pengetahuan) }}">
                                                @endif
                                            </td>
                                            <td class="tabledit-view-mode"><span class="tabledit-span">{{ $row->nilai_keterampilan }}</span>
                                                @if ($tahun_ajaran->is_aktif)
                                                <input class="tabledit-input form-control input-sm" type="text" name="nilai_keterampilan" value="{{ trim($row->nilai_keterampilan) }}">
                                                @endif
                                            </td>
                                            <td class="tabledit-view-mode"><span class="tabledit-span">{{ $row->deskripsi_keterampilan }}</span>
                                                @if ($tahun_ajaran->is_aktif)
                                                <input class="tabledit-input form-control input-sm" type="text" name="deskripsi_keterampilan" value="{{ trim($row->deskripsi_keterampilan) }}">
                                                @endif
                                            </td>
                                            <input class="tabledit-input form-control input-sm" type="hidden" name="_token" value="{{ csrf_token() }}">
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Body end -->
    </div>
@endsection

@push('script')
    @if ($tahun_ajaran->is_aktif)
    <script type="text/javascript" src="{{ asset('adminty/files/assets/pages/edit-table/jquery.tabledit.js') }}"></script>
    @endif
    <script>

        const url = '{{ route('nilai.store') }}';

        $(document).ready(function() {
            $('#example-2').Tabledit({
                url: url,
                autoFocus: false,
                deleteButton: false,
                columns: {
                    identifier: [0, 'id'],
                    editable: [[2, 'nilai_pengetahuan'], [3, 'deskripsi_pengetahuan'], [4, 'nilai_keterampilan'], [5, 'deskripsi_keterampilan']]
                },
                buttons: {
                    edit: {
                        class: 'btn btn-sm btn-primary btn-edit d-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Ubah Nilai"',
                        html: '<i class="feather icon-edit mx-auto"></i>',
                        action: 'edit'
                    },
                    save: {
                        class: 'btn btn-sm btn-success',
                        html: 'Save'
                    }
                },
                onAjax: function(action, serialize) {
                    console.log('onAjax(action, serialize)');
                },
                onSuccess: function(data, textStatus, jqXHR) {
                    if(data.status){
                        notify('fas fa-check', 'success', data.message);
                        return;
                    }
                    notify('fas fa-exclamation-circle', 'warning', 'Opss Something went wrong');
                },
                onFail: function(jqXHR, textStatus, errorThrown) {
                    notify('fas fa-exclamation-circle', 'danger', errorThrown);
                    setTimeout(()=>{
                        location.reload();
                    }, 3000)
                },
            });
        });

        // show success notification on success
        @if ($message = session('success'))
            const message = '{{ $message }}'
            notify('fas fa-check', 'success', message);
        @endif

    </script>
@endpush

