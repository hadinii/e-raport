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
                            <span>Halaman input nilai pelajaran</span>
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
                                            <th>Nilai Keterampilan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($nilai as $row)
                                        <tr>
                                            <form action="{{ route('nilai.store') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="jadwal_id" value="{{ $jadwal->id }}">
                                                <th scope="row"><span class="tabledit-span">{{ $loop->iteration }}</span>
                                                    <input class="tabledit-input form-control input-sm" type="hidden" name="id" value="{{ trim($row->id) }}">
                                                </th>
                                                <td>{{ $row->raport->nama_siswa }}</td>
                                                <td class="tabledit-view-mode">
                                                    <input class="tabledit-input form-control input-sm" type="text" id="nilai_pengetahuan_{{ $row->id }}" name="nilai_pengetahuan" value="{{ trim($row->nilai_pengetahuan) }}" readonly>
                                                </td>
                                                <td class="tabledit-view-mode">
                                                    <input class="tabledit-input form-control input-sm" type="text" id="nilai_keterampilan_{{ $row->id }}" name="nilai_keterampilan" value="{{ trim($row->nilai_keterampilan) }}" readonly>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-inverse btn-edit-nilai {{ $tahun_ajaran->is_aktif ? '' : 'btn-disabled' }}" data-id="{{ $row->id }}">Ubah</button>
                                                    <button type="submit" class="btn btn-sm btn-inverse btn-save-nilai d-none" data-id="{{ $row->id }}">Simpan</button>
                                                </td>
                                            </form>
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

        // btn edit nilai
        $('.btn-edit-nilai').click(function() {
            const id = $(this).data('id');
            $('#nilai_pengetahuan_'+id).attr('readonly', false);
            $('#nilai_keterampilan_'+id).attr('readonly', false);
            $(this).addClass('d-none');
            $('.btn-save-nilai').removeClass('d-none');
        });
        
        // btn save nilai
        // $('.btn-save-nilai').click(function() {
        //     const id = $(this).data('id');
        //     $('#nilai_pengetahuan_'+id).attr('readonly', false);
        //     $('#nilai_keterampilan_'+id).attr('readonly', false);
        //     $(this).addClass('d-none');
        //     $('.btn-save-nilai').removeClass('d-none');
        // });



        // $(document).ready(function() {
        //     $('#example-2').Tabledit({
        //         url: url,
        //         autoFocus: false,
        //         deleteButton: false,
        //         columns: {
        //             identifier: [0, 'id'],
        //             editable: [[2, 'nilai_pengetahuan'], [3, 'deskripsi_pengetahuan'], [4, 'nilai_keterampilan'], [5, 'deskripsi_keterampilan']]
        //         },
        //         buttons: {
        //             edit: {
        //                 class: 'btn btn-sm btn-primary btn-edit d-inline" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Ubah Nilai"',
        //                 html: '<i class="feather icon-edit mx-auto"></i>',
        //                 action: 'edit'
        //             },
        //             save: {
        //                 class: 'btn btn-sm btn-success',
        //                 html: 'Save'
        //             }
        //         },
        //         onAjax: function(action, serialize) {
        //             console.log('onAjax(action, serialize)');
        //         },
        //         onSuccess: function(data, textStatus, jqXHR) {
        //             if(data.status){
        //                 notify('fas fa-check', 'success', data.message);
        //                 return;
        //             }
        //             notify('fas fa-exclamation-circle', 'warning', 'Opss Something went wrong');
        //         },
        //         onFail: function(jqXHR, textStatus, errorThrown) {
        //             notify('fas fa-exclamation-circle', 'danger', errorThrown);
        //             setTimeout(()=>{
        //                 // location.reload();
        //             }, 3000)
        //         },
        //     });
        // });

        // show success notification on success
        @if ($message = session('success'))
            const message = '{{ $message }}'
            notify('fas fa-check', 'success', message);
        @endif

    </script>
@endpush

