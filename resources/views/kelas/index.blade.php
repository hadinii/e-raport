<?php
$title = 'Data Kelas';
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
                            <span>Halaman Data Kelas Digunakan untuk Melihat, Menambah dan Menghapus Data Kelas</span>
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
                            <form action="{{ route('kelas.index') }}">
                                <div class="col-4 form-group row px-0">
                                    <label class="col-sm-5 col-form-label">Tahun Ajaran :</label>
                                    <div class="col-sm-7">
                                        <select id="semester" name="semester" class="form-control custom-select">
                                            @if (!$semester->isEmpty())
                                                @foreach ($semester as $row)
                                                    <option value="{{ $row->id }}" {{ $currentSemester->id == $row->id ? 'selected' : '' }}>{{ $row->tahun_aktif.' - '.$row->semester }}</option>
                                                @endforeach
                                            @else
                                                <option value=""> - </option>
                                            @endif
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
                            @if (optional($currentSemester)->is_aktif)
                                <a href="{{ route('kelas.create') }}" class="btn btn-sm btn-primary float-right">
                                    <i class="feather icon-plus"></i>Tambah Kelas
                                </a>
                            @endif
                        </div>
                        <div class="card-block">
                            <div class="dt-responsive table-responsive">
                                <table id="simpletable" class="table table-striped table-bordered nowrap">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Wali Kelas</th>
                                        <th>Jumlah Siswa</th>
                                        <th>Jumlah Mata Pelajaran</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($currentSemester->kelas ?? [] as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $row->nama_lengkap }}</td>
                                            <td>{{ $row->wali_kelas->nama }}</td>
                                            <td>{{ $row->jumlah_siswa }}</td>
                                            <td>{{ $row->jumlah_mapel }}</td>
                                            <td>
                                                <a href="{{ route('kelas.show', $row->id) }}" class="btn btn-sm btn-inverse px-2" data-id="{{ $row->id }}" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Info">
                                                    <i class="feather icon-info mx-auto"></i>
                                                </a>
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
        <!-- Modal edit start -->
        <div class="modal fade" id="modal-create-edit" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Guru</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="form-create-edit" action="{{ route('kelas.update') }}" method="POST">
                        @csrf
                        @method('PUT')
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
                            <input type="hidden" name="tahun_ajaran_id" id="tahun_ajaran_id" value="{{ $currentSemester->id ?? null }}">
                            <div class="form-group form-primary row">
                                <div class="col-2">
                                    <select name="tingkat_id" id="tingkat_id" class="form-control">
                                        <option value="1">I</option>
                                        <option value="2">II</option>
                                        <option value="3">III</option>
                                        <option value="4">IV</option>
                                        <option value="5">V</option>
                                        <option value="6">VI</option>
                                    </select>
                                </div>
                                <div class="col-10">
                                    <input type="text" id="nama" name="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="Nama Kelas" value="{{ old('nama') }}" required>
                                </div>
                            </div>
                            <div class="form-group form-primary">
                                <select id="wali_kelas_id" name="wali_kelas_id" class="form-control @error('wali_kelas_id') is-invalid @enderror" required>
                                    <option value="">Wali Kelas</option>
                                    @foreach ($guru as $row => $id)
                                        <option value="{{ $id }}" {{ old('wali_kelas_id') == $id ? 'Selected' : '' }}>{{ $row }}</option>
                                    @endforeach
                                </select>
                                <span class="form-bar"></span>
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
                        <h4 class="modal-title">Hapus data kelas</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="form-delete" action="{{ route('kelas.destroy') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            <p class="text-center">Apakah anda yakin ingin menghapus data kelas ini ?</p>
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

    <script>

        const url = '{{ route('kelas.index') }}';

        $(document).ready(function() {
            $('#simpletable').DataTable();
        });

        // on edit btn clicked
        $('.btn-edit').click(function() {
            $('#modal-create-edit').modal('show');
            const form = $(this).data('form');

            // change url to specific row
            $('#form-create-edit').attr('action', `${url}/${form.id}`);

            // change form to specific row
            $('#nama').val(form.nama);
            $('#tingkat_id').val(form.tingkat_id);
            $('#wali_kelas_id').val(form.wali_kelas_id);
        });

        // on delete btn clicked
        $('.btn-delete').click(function() {
            $('#modal-delete').modal('show');
            const id = $(this).data('id');

            // change url to specific row
            $('#form-delete').attr('action', `${url}/${id}`);
        });

        // show success notification on success
        @if ($message = session('success'))
            const message = '{{ $message }}'
            notify('fas fa-check', 'success', message);
        @endif

    </script>
@endpush
