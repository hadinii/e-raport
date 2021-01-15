<?php
$title = 'Raport';
$showNav = true;
$user = Auth::user();
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
                                    <a href="{{ route('raport.print', $raport) }}" class="btn btn-sm btn-inverse"><i class="fas fa-download"></i> Download</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Sikap Kompetensi --}}
                    <div class="card">
                        <div class="card-header">
                            <h5 class="my-1">A. Sikap Kompetensi</h5>
                            <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis deserunt perferendis, eum similique totam nesciunt perspiciatis!</span>
                            <div class="card-header-right">
                                <ul class="list-unstyled card-option">
                                    <li data-toggle="tooltip" data-placement="top" title="" data-original-title="Minimize">
                                        <i class="feather minimize-card icon-minus"></i>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-block">
                            <div class="col-12 mt-3">
                                <form action="{{ route('raport.update', $raport) }}" method="POST">
                                    @csrf
                                    @method('PUT')
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
                                                <td class="{{ $raport->sikap_spiritual ?? 'text-danger' }}">
                                                    <textarea name="sikap_spiritual" id="sikap_spiritual" class="form-control" rows="5" readonly>{{ $raport->sikap_spiritual ?? 'Belum diisi' }}</textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Sikap Sosial</td>
                                                <td class="{{ $raport->sikap_sosial ?? 'text-danger' }}">
                                                    <textarea name="sikap_sosial" id="sikap_sosial" class="form-control" rows="5" readonly>{{ $raport->sikap_sosial ?? 'Belum diisi' }}</textarea>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    @if ($tahun_ajaran->is_aktif && $kelas->wali_kelas_id == $user->id)
                                    <button type="button" class="btn btn-sm btn-inverse btn-edit-sikap float-right"><i class="fas fa-download"></i> Ubah</button>
                                    <button type="submit" class="btn btn-sm btn-inverse btn-save-sikap float-right d-none"><i class="fas fa-download"></i> Simpan</button>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- Kompetensi Pengetahuan dan Keterampilan --}}
                    <div class="card">
                        <div class="card-header">
                            <h5 class="my-1">B. Kompetensi Pengetahuan dan Keterampilan</h5>
                            <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis deserunt perferendis, eum similique totam nesciunt perspiciatis!</span>
                            <div class="card-header-right">
                                <ul class="list-unstyled card-option">
                                    <li data-toggle="tooltip" data-placement="top" title="" data-original-title="Minimize">
                                        <i class="feather minimize-card icon-minus"></i>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-block">
                            <div class="col-12 mt-3">
                                <table id="simpletable" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr class="bg-dark">
                                            <th rowspan="2">No</th>
                                            <th rowspan="2">Muatan Pelajaran</th>
                                            <th colspan="3" class="text-center">Pengetahuan</th>
                                            <th colspan="3" class="text-center">Keterampilan</th>
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
                                        @foreach ($nilai as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $row->pelajaran->nama }}</td>
                                            <td>{{ $row->nilai_pengetahuan }}</td>
                                            <td>{{ $row->nilai_pengetahuan }}</td>
                                            <td class="{{ $row->deskripsi_pengetahuan ?? 'text-danger' }}">{{ $row->deskripsi_pengetahuan ?? 'Belum diisi' }}</td>
                                            <td>{{ $row->nilai_keterampilan }}</td>
                                            <td>{{ $row->nilai_keterampilan }}</td>
                                            <td class="{{ $row->deskripsi_keterampilan ?? 'text-danger' }}">{{ $row->deskripsi_keterampilan ?? 'Belum diisi' }}</td>
                                        </tr>
                                        @endforeach
                                        @if (count($nilai) < 1)
                                        <tr>
                                            <td colspan="8" class="text-center">Belum ada nilai</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- Ekstrakurikuler --}}
                    <div class="card">
                        <div class="card-header">
                            <h5 class="my-1">C. Ekstrakurikuler</h5>
                            <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis deserunt perferendis, eum similique totam nesciunt perspiciatis!</span>
                            <div class="card-header-right">
                                <ul class="list-unstyled card-option">
                                    <li data-toggle="tooltip" data-placement="top" title="" data-original-title="Minimize">
                                        <i class="feather minimize-card icon-minus"></i>
                                    </li>
                                </ul>
                            </div>
                            @if ($tahun_ajaran->is_aktif && $kelas->wali_kelas_id == $user->id)
                            <button id="btn-add-ekskul" class="btn btn-sm btn-inverse btn-add-ekskul float-right mr-3" data-id="{{ $raport->id }}"><i class="fas fa-download"></i> + Nilai Ekskul</button>
                            @endif
                        </div>
                        <div class="card-block">
                            <div class="col-12 mt-3">
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
                                        @foreach ($raport->ekskul as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $row->ekskul->nama }}</td>
                                            <td>{{ $row->keterangan }}</td>
                                            <td>
                                                <form action="{{ route('raport.destroy-ekskul', $raport->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="ekskul_id" value="{{$row->ekskul->id}}">
                                                    <button type="submit" class="btn btn-sm btn-danger px-2" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Hapus" @if(!$tahun_ajaran->is_aktif || $kelas->wali_kelas_id != $user->id) disabled @endif>
                                                        <i class="feather icon-trash-2 mx-auto mr-2"></i> Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @if (count($raport->ekskul) < 1)
                                        <tr>
                                            <td colspan="4" class="text-center">Belum ada data</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- Saran Saran --}}
                    <div class="card">
                        <div class="card-header">
                            <h5 class="my-1">D. Saran - saran</h5>
                            <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis deserunt perferendis, eum similique totam nesciunt perspiciatis!</span>
                            <div class="card-header-right">
                                <ul class="list-unstyled card-option">
                                    <li data-toggle="tooltip" data-placement="top" title="" data-original-title="Minimize">
                                        <i class="feather minimize-card icon-minus"></i>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-block">
                            <div class="col-12 mt-3">
                                <form action="{{ route('raport.update', $raport) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <textarea name="saran" id="saran" rows="10" class="form-control" readonly>{{$raport->saran ?? 'Belum diisi'}}</textarea>
                                    @if ($tahun_ajaran->is_aktif && $kelas->wali_kelas_id == $user->id)
                                    <button type="button" class="btn btn-sm btn-inverse btn-edit-saran mt-2 float-right"><i class="fas fa-download"></i> Edit</button>
                                    <button type="submit" class="btn btn-sm btn-inverse btn-save-saran mt-2 float-right d-none"><i class="fas fa-download"></i> Simpan</button>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- Tinggi Berat --}}
                    <div class="card">
                        <div class="card-header">
                            <h5 class="my-1">E. Tinggi dan Berat Badan</h5>
                            <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis deserunt perferendis, eum similique totam nesciunt perspiciatis!</span>
                            <div class="card-header-right">
                                <ul class="list-unstyled card-option">
                                    <li data-toggle="tooltip" data-placement="top" title="" data-original-title="Minimize">
                                        <i class="feather minimize-card icon-minus"></i>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-block">
                            <div class="col-12 mt-3">
                                <form action="{{ route('raport.update', $raport) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <table id="simpletable" class="table table-striped table-bordered nowrap">
                                        <thead>
                                            <tr class="bg-dark">
                                                <th >No</th>
                                                <th>Aspek yang dinilai</th>
                                                <th>Nilai</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Tinggi Badan (Cm)</td>
                                                <td>
                                                    <input type="text" id="tinggi_badan" name="tinggi_badan" class="form-control" placeholder="Tinggi Badan" value="{{$raport->tinggi_badan}}" readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Berat Badan (Kg)</td>
                                                <td>
                                                    <input type="text" id="berat_badan" name="berat_badan" class="form-control" placeholder="Berat Badan" value="{{$raport->berat_badan}}" readonly>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    @if ($tahun_ajaran->is_aktif && $kelas->wali_kelas_id == $user->id)
                                    <button type="button" class="btn btn-sm btn-inverse btn-edit-badan float-right"><i class="fas fa-download"></i> Ubah</button>
                                    <button type="submit" class="btn btn-sm btn-inverse btn-save-badan float-right d-none"><i class="fas fa-download"></i> Simpan</button>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- Kondisi Kesehatan --}}
                    <div class="card">
                        <div class="card-header">
                            <h5 class="my-1">F. Kondisi Kesehatan</h5>
                            <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis deserunt perferendis, eum similique totam nesciunt perspiciatis!</span>
                            <div class="card-header-right">
                                <ul class="list-unstyled card-option">
                                    <li data-toggle="tooltip" data-placement="top" title="" data-original-title="Minimize">
                                        <i class="feather minimize-card icon-minus"></i>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-block">
                            <div class="col-12 mt-3">
                                <form action="{{ route('raport.update', $raport) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <table id="simpletable" class="table table-striped table-bordered nowrap">
                                        <thead>
                                            <tr class="bg-dark">
                                                <th>No</th>
                                                <th>Aspek</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Pendengaran</td>
                                                <td>
                                                    <input type="text" id="kondisi_pendengaran" name="kondisi_pendengaran" class="form-control" placeholder="Kondisi Pendengaran" value="{{$raport->kondisi_pendengaran}}" readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Penglihatan</td>
                                                <td>
                                                    <input type="text" id="kondisi_penglihatan" name="kondisi_penglihatan" class="form-control" placeholder="Kondisi Penglihatan" value="{{$raport->kondisi_penglihatan}}" readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Gigi</td>
                                                <td>
                                                    <input type="text" id="kondisi_gigi" name="kondisi_gigi" class="form-control" placeholder="Kondisi Gigi" value="{{$raport->kondisi_gigi}}" readonly>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    @if ($tahun_ajaran->is_aktif && $kelas->wali_kelas_id == $user->id)
                                    <button type="button" class="btn btn-sm btn-inverse btn-edit-kesehatan mt-2 float-right"><i class="fas fa-download"></i> Edit</button>
                                    <button type="submit" class="btn btn-sm btn-inverse btn-save-kesehatan mt-2 float-right d-none"><i class="fas fa-download"></i> Simpan</button>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- Prestasi --}}
                    <div class="card">
                        <div class="card-header">
                            <h5 class="my-1">G. Prestasi</h5>
                            <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis deserunt perferendis, eum similique totam nesciunt perspiciatis!</span>
                            <div class="card-header-right">
                                <ul class="list-unstyled card-option">
                                    <li data-toggle="tooltip" data-placement="top" title="" data-original-title="Minimize">
                                        <i class="feather minimize-card icon-minus"></i>
                                    </li>
                                </ul>
                            </div>
                            @if ($tahun_ajaran->is_aktif && $kelas->wali_kelas_id == $user->id)
                            <button class="btn btn-sm btn-inverse btn-add-prestasi float-right"><i class="fas fa-download"></i> + Prestasi</button>
                            @endif
                        </div>
                        <div class="card-block">
                            <div class="col-12 mt-3">
                                <table id="simpletable" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr class="bg-dark">
                                            <th>No</th>
                                            <th>Jenis Prestasi</th>
                                            <th>Tingkat</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($prestasi as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $row->nama }}</td>
                                            <td>{{ $row->tingkat }}</td>
                                            <td>
                                                <form action="{{ route('prestasi.destroy', $row) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="raport_id" value="{{$raport->id}}">
                                                    <button type="submit" class="btn btn-sm btn-danger px-2" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Hapus" @if(!$tahun_ajaran->is_aktif || $kelas->wali_kelas_id != $user->id) disabled @endif>
                                                        <i class="feather icon-trash-2 mx-auto mr-2"></i> Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- Ketidakhadiran --}}
                    <div class="card">
                        <div class="card-header">
                            <h5 class="my-1">H. Ketidakhadiran</h5>
                            <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis deserunt perferendis, eum similique totam nesciunt perspiciatis!</span>
                            <div class="card-header-right">
                                <ul class="list-unstyled card-option">
                                    <li data-toggle="tooltip" data-placement="top" title="" data-original-title="Minimize">
                                        <i class="feather minimize-card icon-minus"></i>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-block">
                            <div class="col-12 mt-3">
                            <form action="{{ route('raport.update', $raport) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <table id="simpletable" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>Keterangan</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Sakit</td>
                                            <td>
                                                <input type="number" id="sakit" name="sakit" class="form-control" placeholder="Jumlah Sakit" value="{{$raport->sakit}}" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Izin</td>
                                            <td>
                                                <input type="number" id="izin" name="izin" class="form-control" placeholder="Jumlah Izin" value="{{$raport->izin}}" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tanpa Keterangan</td>
                                            <td>
                                                <input type="number" id="tanpa_keterangan" name="tanpa_keterangan" class="form-control" placeholder="Jumlah Alfa" value="{{$raport->tanpa_keterangan}}" readonly>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                @if ($tahun_ajaran->is_aktif && $kelas->wali_kelas_id == $user->id)
                                <button type="button" class="btn btn-sm btn-inverse btn-edit-kehadiran mt-2 float-right"><i class="fas fa-download"></i> Edit</button>
                                <button type="submit" class="btn btn-sm btn-inverse btn-save-kehadiran mt-2 float-right d-none"><i class="fas fa-download"></i> Simpan</button>
                                @endif
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Body end -->
        <!-- Modal Ekskul -->
        <div class="modal fade" id="modal-ekskul" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Nilai Eksul</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="form-ekskul" action="{{ route('raport.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group form-primary">
                                <select name="ekskul_id" id="ekskul_id" class="form-control">
                                    <option value="">Pilih Ekskul</option>
                                    @foreach ($ekskul as $row)
                                    <option value="{{$row->id}}">{{$row->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group form-primary">
                                <select name="keterangan" id="keterangan" class="form-control">
                                    <option value="">Predikat</option>
                                    <option value="Amat Baik">Amat Baik</option>
                                    <option value="Baik">Baik</option>
                                    <option value="Cukup">Cukup</option>
                                    <option value="Kurang Baik">Kurang Baik</option>
                                </select>
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
        <!-- Modal Prestasi -->
        <div class="modal fade" id="modal-prestasi" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Nilai Eksul</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="form-prestasi" action="{{ route('prestasi.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="siswa_id" value="{{$siswa->id}}">
                        <input type="hidden" name="raport_id" value="{{$raport->id}}">
                        <div class="modal-body">
                            <div class="form-group form-primary">
                                <input type="text" id="prestasi-nama" name="nama" class="form-control" placeholder="Nama Prestasi">
                            </div>
                            <div class="form-group form-primary">
                                <select name="tingkat" id="prestasi-tingkat" class="form-control">
                                    <option value="">Tingkat</option>
                                    <option value="Sekolah">Sekolah</option>
                                    <option value="Kecamatan/Kota">Kecamatan/Kota</option>
                                    <option value="Provinsi">Provinsi</option>
                                    <option value="Nasional">Nasional</option>
                                </select>
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
@if ($tahun_ajaran->is_aktif && $kelas->wali_kelas_id == $user->id)
<script type="text/javascript" src="{{ asset('adminty/files/assets/pages/edit-table/jquery.tabledit.js') }}"></script>
@endif
<script>

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

    // btn add ekskul
    $('.btn-add-ekskul').click(function() {
        $('#modal-ekskul').modal('show');

        let urlRaport = '{{ route('raport.update-ekskul') }}';
        const id = $(this).data('id');
        $('#form-ekskul').attr('action', `${urlRaport}/${id}`)
    });

    // btn add prestasi
    $('.btn-add-prestasi').click(function() {
        $('#modal-prestasi').modal('show');
    });

    // btn saran
    $('.btn-edit-saran').click(function() {
        $('#saran').attr('readonly', false);
        $(this).addClass('d-none');
        $('.btn-save-saran').removeClass('d-none');
    });

    // btn sikap
    $('.btn-edit-sikap').click(function() {
        $('#sikap_spiritual').attr('readonly', false);
        $('#sikap_sosial').attr('readonly', false);
        $(this).addClass('d-none');
        $('.btn-save-sikap').removeClass('d-none');
    });

    // btn badan
    $('.btn-edit-badan').click(function() {
        $('#tinggi_badan').attr('readonly', false);
        $('#berat_badan').attr('readonly', false);
        $(this).addClass('d-none');
        $('.btn-save-badan').removeClass('d-none');
    });

    // btn kesehatan
    $('.btn-edit-kesehatan').click(function() {
        $('#kondisi_pendengaran').attr('readonly', false);
        $('#kondisi_penglihatan').attr('readonly', false);
        $('#kondisi_gigi').attr('readonly', false);
        $(this).addClass('d-none');
        $('.btn-save-kesehatan').removeClass('d-none');
    });

    // btn kehadiran
    $('.btn-edit-kehadiran').click(function() {
        $('#sakit').attr('readonly', false);
        $('#izin').attr('readonly', false);
        $('#tanpa_keterangan').attr('readonly', false);
        $(this).addClass('d-none');
        $('.btn-save-kehadiran').removeClass('d-none');
    });

    // show success notification on success
    @if ($message = session('success'))
        const message = '{{ $message }}'
        notify('fas fa-check', 'success', message);
    @endif
</script>
@endpush
