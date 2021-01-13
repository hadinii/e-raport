<?php
$title = 'Data Siswa';
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
                            <span>Halaman data siswa, digunakan untuk melihat, menambah, mengubah, dan menghapus data siswa. </span>
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
                    <div class="card">
                        <div class="card-header">
                            <h6 class="text-muted"><i class="feather icon-filter"></i> Filter</h6>
                            <div class="card-header-right">
                                <ul class="list-unstyled card-option">
                                    <li><i class="feather minimize-card icon-minus"></i></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-block">
                            <form action="{{route('siswa.index')}}">
                                <div class="col-4 form-group row px-0">
                                    <label class="col-sm-5 col-form-label">Status :</label>
                                    <div class="col-sm-7">
                                        <select name="status" class="form-control">
                                            <option value="">Semua</option>
                                            <option value="Aktif" {{$filter['status'] == 'Aktif' ? 'selected' : ''}}>Aktif</option>
                                            <option value="Non-Aktif" {{$filter['status'] == 'Non-Aktif' ? 'selected' : ''}}>Non-Aktif</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4 form-group row px-0">
                                    <label class="col-sm-5 col-form-label">Tahun Ajaran :</label>
                                    <div class="col-sm-7">
                                        <select name="semester" class="form-control">
                                            <option value="">-</option>
                                            @foreach ($semester as $row)
                                            <option value="{{$row->id}}" {{$row->id == $filter['semester'] ? 'selected' : ''}}>{{$row->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-sm btn-primary float-right">Filter</button>
                            </form>
                        </div>
                    </div>
                    <!-- Zero config.table start -->
                    <div class="card">
                        <div class="card-header">
                            <button class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#modal-create-edit">
                                <i class="feather icon-plus"></i>Tambah Siswa
                            </button>
                        </div>
                        <div class="card-block">
                            <div class="dt-responsive table-responsive">
                                <table id="simpletable" class="table table-striped table-bordered nowrap">
                                    <thead>
                                    <tr>
                                        <th>NISN</th>
                                        <th>Nama</th>
                                        <th>Tempat, Tgl Lahir</th>
                                        <th>Masa Studi</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($siswa as $row)
                                        <tr>
                                            <td>{{ $row->nisn }}</td>
                                            <td>{{ $row->nama }}</td>
                                            <td>{{ $row->tempat_lahir.', '.$row->tanggal_lahir }}</td>
                                            <td>{{ $row->tahun_masuk.' - '.($row->tahun_keluar ?? 'Sekarang') }}</td>
                                            <td>
                                                <label class="badge badge-{{ $row->is_aktif ? 'success' : 'danger'}}">
                                                    {{ $row->is_aktif ? 'Aktif' : 'Non-Aktif' }}
                                                </label>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-inverse px-2" data-id="{{ $row->id }}" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Info">
                                                    <i class="feather icon-info mx-auto"></i>
                                                </button>
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
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Siswa</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="form-create-edit" action="{{ route('siswa.store') }}" method="POST">
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
                            <div class="col-12 row">
                                <div class="col-6">
                                    <div class="form-group form-primary">
                                        <input type="text" id="nama" name="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="Nama Lengkap" value="{{ old('nama') }}" required>
                                        <span class="form-bar"></span>
                                    </div>
                                    <div class="form-group form-primary">
                                        <input type="number" min="0" minlength="10" id="nisn" name="nisn" class="form-control @error('nisn') is-invalid @enderror" placeholder="Nomor Induk Siswa Nasional" value="{{ old('nisn') }}" required>
                                        <span class="form-bar"></span>
                                        <small class="text-muted">Terdiri dari 10 digit angka</small>
                                    </div>
                                    <div class="form-group form-primary">
                                        <select id="jenis_kelamin" name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror" placeholder="Jenis Kelamin" required>
                                            <option value="">Jenis Kelamin</option>
                                            <option value="Laki-Laki" {{ old('jenis_kelamin') == 'Laki-Laki' ? 'Selected' : '' }}>Laki-Laki</option>
                                            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'Selected' : '' }}>Perempuan</option>
                                        </select>
                                        <span class="form-bar"></span>
                                    </div>
                                    <div class="form-group form-primary row">
                                        <div class="col-6">
                                            <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" placeholder="Tempat Lahir" value="{{ old('tempat_lahir') }}" required>
                                        </div>
                                        <div class="col-6">
                                            <input type="text" id="tanggal_lahir" name="tanggal_lahir" class="form-control" placeholder="Tanggal Lahir" value="{{ old('tanggal_lahir') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group form-primary row">
                                        <div class="col-6">
                                            <input type="text" id="tahun_masuk" name="tahun_masuk" class="form-control @error('tahun_masuk') is-invalid @enderror" placeholder="Tahun Masuk" value="{{ old('tahun_masuk') }}" required>
                                            <span class="form-bar"></span>
                                        </div>
                                        <div class="col-6">
                                            <input type="text" id="tahun_keluar" name="tahun_keluar" class="form-control @error('tahun_keluar') is-invalid @enderror" placeholder="Tahun Keluar" value="{{ old('tahun_keluar') }}" disabled>
                                            <span class="form-bar"></span>
                                        </div>
                                        {{-- <small>Kosongkan tahun keluar bila masih dalam masa studi</small> --}}
                                    </div>
                                    <div class="j-unit">
                                        <label class="j-checkbox-toggle">
                                            <input type="checkbox" id="is_aktif" name="is_aktif" class="js-single" checked="{{ old('is_aktif') }}">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>
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
                        <h4 class="modal-title">Hapus data siswa</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="form-delete" action="{{ route('siswa.destroy') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            <p class="text-center">Apakah anda yakin ingin menghapus data siswa ini ?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light ">Hapus</button>
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
    <!-- Date-dropper js -->
    <script type="text/javascript" src="{{ asset('adminty\files\bower_components\datedropper\js\datedropper.min.js') }}"></script>
    <script>

        const url = '{{ route('siswa.index') }}';
        var elemsingle = document.querySelector('#is_aktif');
        var is_aktif = new Switchery(elemsingle, { color: '#4680ff', jackColor: '#fff', size: 'small' });

        $(document).ready(function() {
            $('#simpletable').DataTable();
            $("#tanggal_lahir").dateDropper( {
                format: "d F Y",
                dropWidth: 200,
                dropPrimaryColor: "#1abc9c",
                dropBorder: "1px solid #1abc9c"
            });
        });

        $('#is_aktif').click(function() {
            _switchAktif(elemsingle.checked);
        });

        $('.btn-edit').click(function() {
            $('#modal-create-edit').modal('show');
            const form = $(this).data('form');

            // change url to specific row
            $('#form-create-edit').attr('action', `${url}/${form.id}`);
            $('#method-form-create-edit').val('PUT');

            // change form to specific row
            $('#nama').val(form.nama);
            $('#nisn').val(form.nisn);
            $('#jenis_kelamin').val(form.jenis_kelamin);
            $('#tempat_lahir').val(form.tempat_lahir);
            $('#tanggal_lahir').val(form.tanggal_lahir);
            $('#tahun_masuk').val(form.tahun_masuk);
            $('#tahun_keluar').val(form.tahun_keluar);
            _switchAktif(form.is_aktif);
        });

        // on delete btn clicked
        $('.btn-delete').click(function() {
            $('#modal-delete').modal('show');
            const id = $(this).data('id');

            // change url to specific row
            $('#form-delete').attr('action', `${url}/${id}`);
        });

        // change switch value
        function _switchAktif(val) {
            const tahun_keluar = $('#tahun_keluar');
            if (val) {
                tahun_keluar.val(null);
                tahun_keluar.attr('disabled', true);
            }else {
                tahun_keluar.attr('disabled', false);
            }
            elemsingle.checked = val;
            is_aktif.handleOnchange(val);
        }

        // show modal if any errors
        @if ($errors->any())
            $('#modal-create-edit').modal('show');
        @endif

        // show success notification on success
        @if ($message = session('success'))
            const message = '{{ $message }}'
            notify('fas fa-check', 'success', message);
        @endif
    </script>
@endpush
