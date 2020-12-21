<?php
$title = 'Kelas '.$kelas->nama_lengkap;
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
                            <h4>{{ $title }}</h4>
                            <span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span>
                        </div>
                    </div>
                </div>
                @include('partials.breadcrumb', ['breadcrumbs' => ['kelas.index' => 'Data Kelas']])
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
                                        <label class="col-sm-3 col-form-label">Jumlah Mapel</label>
                                        <label class="col-sm-9 col-form-label">: <strong> {{ $kelas->jumlah_mapel }} </strong> </label>
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
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Anggota Kelas</h5>
                                    <span>Data siswa kelas pada tahun ajaran terkait</span>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li data-toggle="tooltip" data-placement="top" title="" data-original-title="Import Siswa">
                                                <i class="feather import-siswa icon-upload-cloud"></i>
                                            </li>
                                            <li data-toggle="tooltip" data-placement="top" title="" data-original-title="Minimize">
                                                <i class="feather minimize-card icon-minus"></i>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-block">
                                    @foreach ($siswa as $row)
                                        <div class="alert alert-primary border-default mb-3">
                                            <p class="text-dark">
                                                <strong>{{ $row->siswa->nama }}</strong> ( {{ $row->siswa->nisn }} )
                                            </p>
                                        </div>
                                    @endforeach
                                    @if ($siswa->count() < 1)
                                    <p class="text-dark">
                                        Tidak ada siswa kelas, silahkan import data siswa terlebih dahulu !
                                    </p>
                                    @endif
                                </div>
                                {{-- <div class="card-footer">
                                    <button class="btn btn-sm btn-primary float-right"  data-toggle="modal" data-target="#modal-import-siswa">Import</button>
                                </div> --}}
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Pelajaran</h5>
                                    <span>Data pelajaran pada kelas ini</span>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Guru Mapel">
                                                <i class="feather edit-guru icon-edit"></i>
                                            </li>
                                            <li data-toggle="tooltip" data-placement="top" title="" data-original-title="Minimize">
                                                <i class="feather minimize-card icon-minus"></i>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-block">
                                    @foreach ($pelajaran as $row)
                                        <div class="alert alert-primary border-default mb-3">
                                            <p class="text-dark">
                                                <strong>{{ $row->pelajaran->nama }}</strong> ( {{ $row->pelajaran->singkatan }} )
                                            </p>
                                            <p class="text-muted">{{ optional($row->guru)->nama ?? 'Belom ada' }}</p>
                                        </div>
                                    @endforeach
                                </div>
                                {{-- <div class="card-footer">
                                    <button class="btn btn-sm btn-primary float-right"  data-toggle="modal" data-target="#modal-edit-guru">Edit</button>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Body end -->
        <!-- Modal import siswa -->
        <div class="modal fade" id="modal-import-siswa" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Siswa</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="form-delete" action="{{ route('raport.import', $kelas) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="sub-header"><strong>1. Download Template Excel</strong></h6>
                                    <span class="text-16">Download template untuk memasukkan data anggota kelas.</span>
                                    <a href="{{ route('raport.export', $kelas) }}" target="_blank" class="btn btn-sm btn-outline-primary mt-2">Download</a>
                                </div>
                                <div class="card-header">
                                    <h6 class="sub-header"><strong>2. Isi data Siswa</strong></h6>
                                    <span class="text-16">Isi data siswa sesuai dengan anggota. Data yg harus diisi adalah nomor dan NISN, <strong>kelas_id diisi {{$kelas->id}}</strong> </span>
                                    <div class="card-block table-border-style mt-2">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>NISN</th>
                                                        <th>kelas_id</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>1234567890</td>
                                                        <th>{{ $kelas->id }}</th>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>0987654321</td>
                                                        <th>{{ $kelas->id }}</th>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>1234509876</td>
                                                        <th>{{ $kelas->id }}</th>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-header">
                                    <h6 class="sub-header"><strong>3. Upload Template Excel</strong></h6>
                                    <span class="text-16">Upload template yang telah diisi dengan data anggota kelas dengan extension xlxs.</span>
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
        <!-- Modal edit guru -->
        <div class="modal fade" id="modal-edit-guru" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Pelajaran</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="form-delete" action="{{ route('jadwal.update', $kelas) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            @foreach ($pelajaran as $row)
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">{{ $row->pelajaran->singkatan }}</label>
                                <div class="col-sm-9">
                                    <select id="{{ "guru_id-{$row->id}" }}" name="{{ "guru_id-{$row->id}"}}" class="form-control" required>
                                        <option value="">-- Guru Mata Pelajaran --</option>
                                        @foreach ($guru as $prop => $value)
                                            <option value="{{ $value }}" {{ $row->guru_id == $value ? 'selected' : '' }}>{{ $prop }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @endforeach
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
    <script>

        const url = '{{ route('kelas.index') }}';

        $(document).ready(function() {
            $('#upload').click(function() {
                $('#data-siswa').click();
            });

            $('.import-siswa').click(function(){
                $('#modal-import-siswa').modal('show');
            });

            $('.edit-guru').click(function(){
                $('#modal-edit-guru').modal('show');
            });

            $('#data-siswa').change(function() {
                const fileName = $(this).val().split('\\').pop();
                $('#file-name').removeClass('d-none');
                $('#file-name').html(fileName);
            });
        });

        // show success notification on success
        @if ($message = session('success'))
            const message = '{{ $message }}'
            notify('fas fa-check', 'success', message);
        @endif

    </script>
@endpush

