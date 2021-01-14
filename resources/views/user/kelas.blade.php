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
                            <span>Halaman data kelas pada wali kelas digunakan untuk input nilai raport </span>
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
                                        <th>NIP</th>
                                        <th>Tahun Ajaran</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kelas as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $row->nama_lengkap }}</td>
                                            <td>{{ $row->tahun_ajaran->nama }}</td>
                                            <td>
                                                <label class="badge badge-{{ $row->tahun_ajaran->is_aktif ? 'success' : 'danger'}}">
                                                    {{ $row->tahun_ajaran->is_aktif ? 'Aktif' : 'Non-Aktif' }}
                                                </label>
                                            </td>
                                            <td>
                                                <a href="{{ route('kelas.show', $row) }}" class="btn btn-sm btn-inverse px-2" data-id="{{ $row->id }}" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Info">
                                                    <i class="feather icon-info mx-auto"></i>
                                                </a>
                                                @if ($row->tahun_ajaran->is_aktif)
                                                <button class="btn btn-sm btn-primary btn-import px-2" data-id="{{ $row->id }}" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Isi Raport">
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
        <!-- Modal import nilai -->
        <div class="modal fade" id="modal-import" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Import Nilai Raport</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="form-import" action="{{ route('raport.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="sub-header"><strong>1. Download Template Excel</strong></h6>
                                    <span class="text-16">Download template untuk mengisi nilai raport.</span>
                                    <a id="link-export" href="{{ route('raport.export') }}" target="_blank" class="btn btn-sm btn-outline-primary mt-2">Download</a>
                                </div>
                                <div class="card-header">
                                    <h6 class="sub-header"><strong>2. Isi Nilai Raport</strong></h6>
                                    <span class="text-16">Isi data nilai raport sesuai dengan isian yang ada.</span>
                                    <div class="card-block table-border-style mt-2">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>NISN</th>
                                                        <th>Nama</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>1234567890</td>
                                                        <td>Panjul</td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>0987654321</td>
                                                        <td>Udin</td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>1234509876</td>
                                                        <td>Ucok</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-header">
                                    <h6 class="sub-header"><strong>3. Upload Template Excel</strong></h6>
                                    <span class="text-16">Upload template yang telah diisi dengan nilai raport dengan extension xlxs.</span>
                                    <div>
                                        <label id="file-name" class="label bg-primary d-none mt-2"></label>
                                        <br>
                                        <button type="button" class="btn btn-sm btn-outline-primary mt-2" id="upload">Upload</button>
                                        <input type="file" id="data-siswa" name="data-siswa" class="d-none">
                                    </div>
                                </div>
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
    </div>
@endsection

@push('script')
    <!-- data-table js -->
    <script src="{{ asset('adminty\files\bower_components\datatables.net\js\jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminty\files\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js') }}"></script>
    <script>

        $(document).ready(function() {
            $('#simpletable').DataTable();

            $('#upload').click(function() {
                $('#data-siswa').click();
            });

            $('#data-siswa').change(function() {
                const fileName = $(this).val().split('\\').pop();
                $('#file-name').removeClass('d-none');
                $('#file-name').html(fileName);
            });
        });

        // btn import
        $('.btn-import').click(function() {
            $('#modal-import').modal('show');

            let urlExport = '{{ route('raport.export') }}';
            let urlImport = '{{ route('raport.import') }}';
            const id = $(this).data('id');
            $('#link-export').attr('href', `${urlExport}/${id}`);
            $('#form-import').attr('action', `${urlImport}/${id}`)
        });

        // show success notification on success
        @if ($message = session('success'))
            const message = '{{ $message }}'
            notify('fas fa-check', 'success', message);
        @endif
    </script>
@endpush
