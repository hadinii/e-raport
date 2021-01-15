<?php
$title = 'Data Tahun Ajaran';
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
                            <span>Halaman data tahun ajaran, digunakan untuk melihat, menambah, mengubah, dan menghapus data tahun ajaran. </span>
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
                            <button class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#modal-create-edit">
                                <i class="feather icon-plus"></i>Tambah tahun ajaran
                            </button>
                        </div>
                        <div class="card-block">
                            <div class="dt-responsive table-responsive">
                                <table id="simpletable" class="table table-striped table-bordered nowrap">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Kurikulum</th>
                                        <th>Tanggal Raport</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($semester as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $row->tahun_aktif .' - '. $row->semester }}</td>
                                            <td>{{ $row->kurikulum }}</td>
                                            <td>{{ $row->tanggal_raport }}</td>
                                            <td>
                                                <label class="badge badge-{{ $row->is_aktif ? 'success' : 'danger'}}">
                                                    {{ $row->is_aktif ? 'Aktif' : 'Non-Aktif' }}
                                                </label>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-primary btn-edit px-2" data-form="{{ $row }}" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit">
                                                    <i class="feather icon-edit mx-auto"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger btn-delete px-2" data-id="{{ $row->id }}" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Hapus">
                                                    <i class="feather icon-trash-2 mx-auto"></i>
                                                </button>
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
        <!-- Modal create and edit start -->
        <div class="modal fade" id="modal-create-edit" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tahun Ajaran</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="form-create-edit" action="{{ route('tahun.store') }}" method="POST">
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
                                <input type="text" id="tahun_aktif" name="tahun_aktif" class="form-control @error('tahun_aktif') is-invalid @enderror" placeholder="Tahun Aktif" value="{{ old('tahun_aktif') }}" required>
                                <span class="form-bar"></span>
                                <small class="text-muted">Tahun ajaran, cth: 2020/2021</small>
                            </div>
                            <div class="form-group form-primary">
                                <select id="semester" name="semester" class="form-control custom-select treshold-i @error('semester') is-invalid @enderror" placeholder="Semester" required>
                                    <option value="">-- Pilih Semester --</option>
                                    <option value="Ganjil">Ganjil</option>
                                    <option value="Genap">Genap</option>
                                </select>
                                <span class="form-bar"></span>
                            </div>
                            <div class="form-group form-primary">
                                <select id="kurikulum_id" name="kurikulum_id" class="form-control custom-select treshold-i @error('kurikulum_id') is-invalid @enderror" placeholder="Kurikulum" required>
                                    <option value="">-- Pilih Kurikulum --</option>
                                    @foreach ($kurikulum as $row)
                                        <option value="{{ $row->id }}" {{ old('kurikulum_id') == $row->id ? 'Selected' : '' }}>{{ $row->nama }}</option>
                                    @endforeach
                                </select>
                                <span class="form-bar"></span>
                            </div>
                            <div class="form-group form-primary">
                                <input type="date" id="tanggal_raport" name="tanggal_raport" class="form-control @error('tanggal_raport') is-invalid @enderror" placeholder="Tanggal Raport" value="{{ old('tanggal_raport') }}" required>
                                <span class="form-bar"></span>
                                <small class="text-muted">Tanggal yang akan tertera di raport</small>
                            </div>
                            <div class="form-group form-primary">
                                <input type="text" id="nama_kepala_sekolah" name="nama_kepala_sekolah" class="form-control @error('nama_kepala_sekolah') is-invalid @enderror" value="{{ $sekolah->kepala_sekolah }}" readonly>
                                <span class="form-bar"></span>
                            </div>
                            <div class="form-group form-primary">
                                <input type="text" id="nip_kepala_sekolah" name="nip_kepala_sekolah" class="form-control @error('nip_kepala_sekolah') is-invalid @enderror" placeholder="Tanggal Raport" value="{{ $sekolah->nip_kepala_sekolah }}" readonly>
                                <span class="form-bar"></span>
                                <small class="text-muted">Nama dan NIP kepala sekolah yang akan tertera di raport</small>
                            </div>
                            <div class="j-unit">
                                Status :
                                <label class="j-checkbox-toggle">
                                    <input type="checkbox" id="is_aktif" name="is_aktif" class="js-single" checked>
                                </label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light ">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal create and edit end -->
        <!-- Modal delete start -->
        <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Hapus data tahun ajaran</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="form-delete" action="{{ route('user.destroy') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            <p class="text-center">Apakah anda yakin ingin menghapus data tahun ajaran ini ?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <!-- data-table js -->
    <script src="{{ asset('adminty\files\bower_components\datatables.net\js\jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminty\files\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js') }}"></script>
    <!-- Switch component js -->
    <script type="text/javascript" src="{{ asset('adminty\files\bower_components\switchery\js\switchery.min.js') }}"></script>
    <!-- Max-length js -->
    <script type="text/javascript" src="{{ asset('adminty\files\bower_components\bootstrap-maxlength\js\bootstrap-maxlength.js') }}"></script>
    <!-- Moment js -->
    <script type="text/javascript" src="{{ asset('adminty/files/assets/pages/advance-elements/moment-with-locales.min.js') }}"></script>
    <script>

        const url = '{{ route('tahun.index') }}';
        var elemsingle = document.querySelector('#is_aktif');
        var is_aktif = new Switchery(elemsingle, { color: '#4680ff', jackColor: '#fff', size: 'small' });

        $(document).ready(function() {
            $('#simpletable').DataTable();
            $("#tanggal_raport").dateDropper( {
                format: "d F Y",
                dropWidth: 200,
                dropPrimaryColor: "#1abc9c",
                dropBorder: "1px solid #1abc9c"
            });
        });

        $('.btn-edit').click(function() {
            $('#modal-create-edit').modal('show');
            const form = $(this).data('form');

            // change url to specific row
            $('#form-create-edit').attr('action', `${url}/${form.id}`);
            $('#method-form-create-edit').val('PUT');

            console.log(moment(form.tanggal_raport).format("YYYY-MM-DD"));
            // change form to specific row
            $('#tahun_aktif').val(form.tahun_aktif);
            $('#tanggal_raport').val(moment(form.tanggal_raport).format("YYYY-MM-DD"));
            $('#semester').val(form.semester);
            $('#kurikulum_id').val(form.kurikulum_id);
            $('#nama_kepala_sekolah').val(form.nama_kepala_sekolah);
            $('#nip_kepala_sekolah').val(form.nip_kepala_sekolah);
            _switchAktif(form.is_aktif);
        });

        $('.btn-delete').click(function() {
            $('#modal-delete').modal('show');
            const id = $(this).data('id');

            // change url to specific row
            $('#form-delete').attr('action', `${url}/${id}`);
        });

        // change switch value
        function _switchAktif (val) {
            elemsingle.checked = val;
            is_aktif.handleOnchange(val);
        }

        @if ($errors->any())
            $('#modal-create-edit').modal('show');
        @endif

        @if ($message = session('success'))
            const message = '{{ $message }}'
            notify('fas fa-check', 'success', message);
        @endif
    </script>
@endpush
