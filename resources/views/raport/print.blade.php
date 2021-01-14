<?php
$title = 'Raport';
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
                            <span>{{ "$siswa->nama ($raport->nama_tahun_ajaran)" }}</span>
                        </div>
                    </div>
                </div>
                @include('partials.breadcrumb', ['breadcrumbs' => ['user.kelas' => 'Data Kelas', 'kelas.show' => $kelas->nama_lengkap]])
            </div>
        </div>
        <!-- Page Header end -->
        <!-- Page Body start -->
        <div class="page-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <button class="btn btn-sm btn-inverse float-right"><i class="fas fa-download"></i> Download</button>
                        </div>
                        <div class="card-block">
                            <div class="col-12 row">
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Nama Peserta Didik</label>
                                        <label class="col-sm-8 col-form-label">: <strong> {{ $siswa->nama }} </strong> </label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">NISN</label>
                                        <label class="col-sm-8 col-form-label">: <strong> {{ $siswa->nisn }} </strong> </label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Nama Sekolah</label>
                                        <label class="col-sm-8 col-form-label">: <strong> {{ $sekolah->nama }} </strong> </label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Alamat Sekolah</label>
                                        <label class="col-sm-8 col-form-label">: <strong> {{ $sekolah->alamat }} </strong> </label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Kelas</label>
                                        <label class="col-sm-8 col-form-label">: <strong> {{ $kelas->nama_lengkap }} </strong> </label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Semester</label>
                                        <label class="col-sm-8 col-form-label">: <strong> {{ $tahun_ajaran->semester }} </strong> </label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Tahun Ajaran</label>
                                        <label class="col-sm-8 col-form-label">: <strong> {{ $tahun_ajaran->tahun_aktif }} </strong> </label>
                                    </div>
                                </div>
                            </div>
                            {{-- Sikap Kompetensi --}}
                            <div class="col-12 mt-3">
                                <h5 class="my-1">A. Sikap Kompetensi</h5>
                                <table id="simpletable" class="table table-striped table-bordered nowrap">
                                    <thead>
                                    <tr class="bg-dark">
                                        <th colspan="4" class="text-center">Deskripsi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Sikap Spiritual</td>
                                            <td class="{{ $raport->sikap_spiritual ?? 'text-danger' }}">{{ $raport->sikap_spiritual ?? 'Belum diisi' }}</td>
                                            <td>
                                                <a href="{{ route('raport.show') }}" class="btn btn-sm btn-warning px-2" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit">
                                                    <i class="feather icon-info mx-auto mr-2"></i> Edit
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Sikap Sosial</td>
                                            <td class="{{ $raport->sikap_spiritual ?? 'text-danger' }}">{{ $raport->sikap_sosial ?? 'Belum diisi' }}</td>
                                            <td>
                                                <a href="{{ route('raport.show') }}" class="btn btn-sm btn-warning px-2" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit">
                                                    <i class="feather icon-info mx-auto mr-2"></i> Edit
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            {{-- Kompetensi Pengetahuan dan Keterampilan --}}
                            <div class="col-12 mt-3">
                                <h5 class="my-1">B. Kompetensi Pengetahuan dan Keterampilan</h5>
                                <table id="simpletable" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr class="bg-dark">
                                            <th rowspan="2">No</th>
                                            <th rowspan="2">Muatan Pelajaran</th>
                                            <th colspan="3" class="text-center">Pengetahuan</th>
                                            <th colspan="3" class="text-center">Keterampilan</th>
                                            <th rowspan="2"></th>
                                        </tr>
                                        <tr class="bg-dark">
                                            <th>Nilai</th>
                                            <th>Predikat</th>
                                            <th>Deskripsi</th>
                                            <th>Nilai</th>
                                            <th>Predikat</th>
                                            <th>Deskripsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            @foreach ($nilai as $row)
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $row->pelajaran->nama }}</td>
                                            <td>{{ $row->nilai_pengetahuan }}</td>
                                            <td>{{ $row->nilai_pengetahuan }}</td>
                                            <td class="{{ $row->deskripsi_pengetahuan ?? 'text-danger' }}">{{ $row->deskripsi_pengetahuan ?? 'Belum diisi' }}</td>
                                            <td>{{ $row->nilai_keterampilan }}</td>
                                            <td>{{ $row->nilai_keterampilan }}</td>
                                            <td class="{{ $row->deskripsi_keterampilan ?? 'text-danger' }}">{{ $row->deskripsi_keterampilan ?? 'Belum diisi' }}</td>
                                            <td>
                                                <a href="{{ route('raport.show') }}" class="btn btn-sm btn-warning px-2" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit">
                                                    <i class="feather icon-info mx-auto mr-2"></i> Edit
                                                </a>
                                            </td>
                                            @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            {{-- Ekstrakurikuler --}}
                            <div class="col-12 mt-3">
                                <h5 class="my-1">C. Ekstrakurikuler</h5>
                                <table id="simpletable" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr class="bg-dark">
                                            <th >No</th>
                                            <th>Kegiatan Ekstrakurikuler</th>
                                            <th>Keterangan</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            @foreach ($nilai as $row)
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $row->pelajaran->nama }}</td>
                                            <td>{{ $row->pelajaran->nama }}</td>
                                            <td>
                                                <a href="{{ route('raport.show') }}" class="btn btn-sm btn-warning px-2" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit">
                                                    <i class="feather icon-info mx-auto mr-2"></i> Edit
                                                </a>
                                            </td>
                                            @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            {{-- Saran Saran --}}
                            <div class="col-12 mt-3">
                                <h5 class="my-1">D. Saran - saran</h5>
                                <table id="simpletable" class="table table-striped table-bordered nowrap">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <p>{{ $raport->saran }}</p>
                                            </td>
                                            <td>
                                                <a href="{{ route('raport.show') }}" class="btn btn-sm btn-warning px-2" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit">
                                                    <i class="feather icon-info mx-auto mr-2"></i> Edit
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            {{-- Tinggi Berat --}}
                            <div class="col-12 mt-3">
                                <h5 class="my-1">E. Tinggi dan Berat Badan</h5>
                                <table id="simpletable" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr class="bg-dark">
                                            <th >No</th>
                                            <th>Aspek yang dinilai</th>
                                            <th>Nilai</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Tinggi Badan</td>
                                            <td>{{$raport->tinggi_badan}}</td>
                                            <td>
                                                <a href="{{ route('raport.show') }}" class="btn btn-sm btn-warning px-2" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit">
                                                    <i class="feather icon-info mx-auto mr-2"></i> Edit
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Berat Badan</td>
                                            <td>{{$raport->berat_badan}}</td>
                                            <td>
                                                <a href="{{ route('raport.show') }}" class="btn btn-sm btn-warning px-2" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit">
                                                    <i class="feather icon-info mx-auto mr-2"></i> Edit
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            {{-- Kondisi Kesehatan --}}
                            <div class="col-12 mt-3">
                                <h5 class="my-1">F. Kondisi Kesehatan</h5>
                                <table id="simpletable" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr class="bg-dark">
                                            <th>No</th>
                                            <th>Aspek</th>
                                            <th>Keterangan</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Pendengaran</td>
                                            <td>{{$raport->kondisi_pendengaran}}</td>
                                            <td>
                                                <a href="{{ route('raport.show') }}" class="btn btn-sm btn-warning px-2" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit">
                                                    <i class="feather icon-info mx-auto mr-2"></i> Edit
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Penglihatan</td>
                                            <td>{{$raport->kondisi_penglihatan}}</td>
                                            <td>
                                                <a href="{{ route('raport.show') }}" class="btn btn-sm btn-warning px-2" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit">
                                                    <i class="feather icon-info mx-auto mr-2"></i> Edit
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Gigi</td>
                                            <td>{{$raport->kondisi_gigi}}</td>
                                            <td>
                                                <a href="{{ route('raport.show') }}" class="btn btn-sm btn-warning px-2" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit">
                                                    <i class="feather icon-info mx-auto mr-2"></i> Edit
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            {{-- Prestasi --}}
                            <div class="col-12 mt-3">
                                <h5 class="my-1">G. Prestasi</h5>
                                <table id="simpletable" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr class="bg-dark">
                                            <th>No</th>
                                            <th>Jenis Prestasi</th>
                                            <th>Keterangan</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            @foreach ($nilai as $row)
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $row->pelajaran->nama }}</td>
                                            <td>{{ $row->pelajaran->nama }}</td>
                                            <td>
                                                <a href="{{ route('raport.show') }}" class="btn btn-sm btn-warning px-2" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit">
                                                    <i class="feather icon-info mx-auto mr-2"></i> Edit
                                                </a>
                                            </td>
                                            @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            {{-- Ketidakhadiran --}}
                            <div class="col-12 mt-3">
                                <h5 class="my-1">H. Ketidakhadiran</h5>
                                <table id="simpletable" class="table table-striped table-bordered nowrap">
                                    <tbody>
                                        <tr>
                                            <td>Sakit</td>
                                            <td>{{$raport->sakit}}</td>
                                            <td>
                                                <a href="{{ route('raport.show') }}" class="btn btn-sm btn-warning px-2" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit">
                                                    <i class="feather icon-info mx-auto mr-2"></i> Edit
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Izin</td>
                                            <td>{{$raport->izin}}</td>
                                            <td>
                                                <a href="{{ route('raport.show') }}" class="btn btn-sm btn-warning px-2" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit">
                                                    <i class="feather icon-info mx-auto mr-2"></i> Edit
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tanpa Keterangan</td>
                                            <td>{{$raport->tanpa_keterangan}}</td>
                                            <td>
                                                <a href="{{ route('raport.show') }}" class="btn btn-sm btn-warning px-2" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Edit">
                                                    <i class="feather icon-info mx-auto mr-2"></i> Edit
                                                </a>
                                            </td>
                                        </tr>
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
