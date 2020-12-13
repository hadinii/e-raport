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
                                    {{-- <li><i class="feather full-card icon-maximize"></i></li> --}}
                                    <li><i class="feather minimize-card icon-minus"></i></li>
                                    {{-- <li><i class="feather icon-trash-2 close-card"></i></li> --}}
                                </ul>
                            </div>
                        </div>
                        <div class="card-block">
                            <div class="col-4 form-group row px-0">
                                <label class="col-sm-5 col-form-label">Status :</label>
                                <div class="col-sm-7">
                                    <select name="status" class="form-control">
                                        <option value="">Semua</option>
                                        <option value="Aktif">Aktif</option>
                                        <option value="Non-Aktif">Non-Aktif</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4 form-group row px-0">
                                <label class="col-sm-5 col-form-label">Tahun Masuk :</label>
                                <div class="col-sm-7">
                                    <select name="status" class="form-control">
                                        <option value="">Semua</option>
                                        <option value="Aktif">Aktif</option>
                                        <option value="Non-Aktif">Non-Aktif</option>
                                    </select>
                                </div>
                            </div>
                            <button class="btn btn-sm btn-primary float-right">Filter</button>
                        </div>
                    </div>
                    <!-- Zero config.table start -->
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('siswa.create') }}" class="btn btn-sm btn-primary float-right">
                                <i class="feather icon-plus"></i>Tambah Siswa
                            </a>
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
                                                <button class="btn btn-sm btn-primary btn-edit px-2" data-form="{{ $row }}" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit">
                                                    <i class="feather icon-edit mx-auto"></i>
                                                </button>
                                                <button class="btn btn-sm btn-warning px-2" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Ubah Password">
                                                    <i class="feather icon-unlock mx-auto"></i>
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
                        <h4 class="modal-title">Guru</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
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
                                <small class="text-muted">Nama lengkap dan gelar</small>
                            </div>
                            <div class="form-group form-primary">
                                <input type="number" min="0" minlength="18" id="nip" name="nip" class="form-control @error('nip') is-invalid @enderror" placeholder="NIP" value="{{ old('nip') }}" required>
                                <span class="form-bar"></span>
                                <small class="text-muted">Nomor Induk Pengajar. 18 digit angka</small>
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
        <!-- Modal create and edit end -->
        <!-- Modal delete start -->
        <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Hapus data guru</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="form-delete" action="{{ route('user.destroy') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            <p class="text-center">Apakah anda yakin ingin menghapus data guru ini ?</p>
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
        $(document).ready(function() {
            $('#simpletable').DataTable();
        });

        $('.btn-edit').click(function() {
            $('#modal-create-edit').modal('show');
            const form = $(this).data('form');

            // change url to specific row
            const url = '{{ route('user.update') }}';
            $('#form-create-edit').attr('action', `${url}/${form.id}`);
            $('#method-form-create-edit').val('PUT');


            // change form to specific row
            $('#nama').val(form.nama);
            $('#nip').val(form.nip);
        });

        $('.btn-delete').click(function() {
            $('#modal-delete').modal('show');
            const id = $(this).data('id');

            // change url to specific row
            const url = '{{ route('user.update') }}';
            $('#form-delete').attr('action', `${url}/${id}`);
        });

        @if ($errors->any())
            $('#modal-create-edit').modal('show');
        @endif

        @if ($message = session('success'))
            const message = '{{ $message }}'
            notify('fas fa-check', 'success', message);
        @endif
    </script>
@endpush
