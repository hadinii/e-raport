<?php
$title = 'Raport';
$user = Auth::user();
?>
@extends('layouts.print')

@section('title', $title)

@push('style')
<style type="text/css">
    table {
        border-collapse:collapse;
        border-spacing:0;
        width: 100%
    }
</style>
<style type="text/css">
    .tg  {border-collapse:collapse;border-spacing:0;width: 100%}
    .tg td{border-style:none;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
      overflow:hidden;padding:10px 5px;word-break:normal;}
    .tg th{border-style:none;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
      font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
    .tg .tg-ng7p{border-color:#330001;text-align:left;vertical-align:top}
    .tg .tg-iks7{background-color:#ffffff;border-color:#000000;text-align:left;vertical-align:top}
    .tg .tg-73oq{border-color:#000000;text-align:left;vertical-align:top}
</style>
<style type="text/css">
    .tg-1  {border-collapse:collapse;border-spacing:0; width: 100%}
    .tg-1 td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
      overflow:hidden;padding:10px 5px;word-break:normal;}
    .tg-1 th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
      font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
    .tg-1 .tg-a{background-color:#c0c0c0;border-color:#000000;text-align:center;vertical-align:top}
    .tg-1 .tg-a-1{border-color:#330001;text-align:left;vertical-align:top}
    .tg-1 .tg-a-2{border-color:#000000;text-align:left;vertical-align:top}
</style>
<style type="text/css">
    .tg-2  {border-collapse:collapse;border-spacing:0;}
    .tg-2 td{font-family:Arial, sans-serif;font-size:14px;
      overflow:hidden;padding:10px 5px;word-break:normal;}
    .tg-2 th{font-family:Arial, sans-serif;font-size:14px;
      font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
    .tg-2 .tg-wp8o{border-color:#000000;text-align:center;vertical-align:top}
    .tg-2 .tg-ths0{border-color:#330001;text-align:right;vertical-align:top}
    .tg-2 .tg-0lax{text-align:left;vertical-align:top}
</style>
<style type="text/css">
    .tg-3  {border-collapse:collapse;border-spacing:0;}
    .tg-3 td{font-family:Arial, sans-serif;font-size:14px;
      overflow:hidden;padding:10px 5px;word-break:normal;}
    .tg-3 th{font-family:Arial, sans-serif;font-size:14px;
      font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
    .tg-3 .tg-baqh{text-align:center;vertical-align:top}
    .tg-3 .tg-wp8o{border-color:#000000;text-align:center;vertical-align:top}
    .tg-3 .tg-8g55{border-color:#330001;text-align:center;vertical-align:top}
    .tg-3 .tg-0lax{text-align:left;vertical-align:top}
</style>
@endpush

@section('content')
    <div class="page-wrapper">
        <!-- Page Body start -->
        <div class="page-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <table class="tg">
                            <thead>
                                <tr>
                                <th class="tg-iks7">Nama Peserta Didik</th>
                                <th class="tg-iks7"><strong> {{ $siswa->nama }} </strong></th>
                                <th class="tg-iks7">Kelas</th>
                                <th class="tg-iks7"><strong> {{ $kelas->nama_lengkap }} </strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <td class="tg-ng7p">NISN</td>
                                <td class="tg-73oq"><strong> {{ $siswa->nisn }} </strong></td>
                                <td class="tg-73oq">Semester</td>
                                <td class="tg-73oq"><strong> {{ $tahun_ajaran->semester }} </strong></td>
                                </tr>
                                <tr>
                                <td class="tg-73oq">Nama Sekolah</td>
                                <td class="tg-73oq"><strong> {{ $sekolah->nama }} </strong></td>
                                <td class="tg-73oq">Tahun Ajaran</td>
                                <td class="tg-73oq"><strong> {{ $tahun_ajaran->tahun_aktif }} </strong> </td>
                                </tr>
                                <tr>
                                <td class="tg-73oq">Alamat Sekolah</td>
                                <td class="tg-73oq"><strong> {{ $sekolah->alamat }} </strong></td>
                                <td class="tg-73oq"></td>
                                <td class="tg-73oq"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    {{-- Sikap Kompetensi --}}
                    <div class="card">
                        <div class="card-header">
                            <h5 class="my-1">A. Sikap Kompetensi</h5>
                        </div>
                        <div class="card-block">
                            <div class="col-12 mt-3">
                                <table class="tg-1">
                                    <thead>
                                      <tr>
                                        <th class="tg-a" colspan="3">Deskripsi</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td class="tg-a-1">1</td>
                                        <td class="tg-a-1">Sikap Spiritual</td>
                                        <td class="tg-a-2 {{ $raport->sikap_spiritual ?? 'text-danger' }}">
                                            {{ $raport->sikap_spiritual ?? 'Belum diisi' }}
                                        </td>
                                      </tr>
                                      <tr>
                                        <td class="tg-a-2">2</td>
                                        <td class="tg-a-1">Sikap Sosial</td>
                                        <td class="tg-a-2 {{ $raport->sikap_sosial ?? 'text-danger' }}">
                                            {{ $raport->sikap_sosial ?? 'Belum diisi' }}
                                        </td>
                                      </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- Kompetensi Pengetahuan dan Keterampilan --}}
                    <div class="card">
                        <div class="card-header">
                            <h5 class="my-1">B. Kompetensi Pengetahuan dan Keterampilan</h5>
                        </div>
                        <div class="card-block">
                            <div class="col-12 mt-3">
                                <table class="tg-1">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" class="tg-a">No</th>
                                            <th rowspan="2" class="tg-a">Muatan Pelajaran</th>
                                            <th colspan="3" class="tg-a">Pengetahuan</th>
                                            <th colspan="3" class="tg-a">Keterampilan</th>
                                        </tr>
                                        <tr>
                                            <th class="tg-a">Nilai</th>
                                            <th class="tg-a">Predikat</th>
                                            <th class="tg-a">Deskripsi</th>
                                            <th class="tg-a">Nilai</th>
                                            <th class="tg-a">Predikat</th>
                                            <th class="tg-a">Deskripsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($nilai as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $row->pelajaran->nama }}</td>
                                            <td>{{ $row->nilai_pengetahuan }}</td>
                                            <td>{{ $row->nilai_pengetahuan < 85 ? ($row->nilai_pengetahuan < 67 ? 'C' : 'B' ) : 'A' }}</td>
                                            <td class="{{ $row->deskripsi_pengetahuan ?? 'text-danger' }}">{{ $row->deskripsi_pengetahuan ?? 'Belum diisi' }}</td>
                                            <td>{{ $row->nilai_keterampilan }}</td>
                                            <td>{{ $row->nilai_keterampilan < 85 ? ($row->nilai_keterampilan < 67 ? 'C' : 'B' ) : 'A' }}</td>
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
                        </div>
                        <div class="card-block">
                            <div class="col-12 mt-3">
                                <table class="tg-1">
                                    <thead>
                                        <tr>
                                            <th class="tg-a">No</th>
                                            <th class="tg-a">Kegiatan Ekstrakurikuler</th>
                                            <th class="tg-a">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($raport->ekskul as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $row->ekskul->nama }}</td>
                                            <td>{{ $row->keterangan }}</td>
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
                        </div>
                        <div class="card-block">
                            <div class="col-12 mt-3" style="min-height: 100px; border-style: solid; border-width: 1px;">
                                <p>{{$raport->saran ?? 'Belum diisi'}}</p>
                            </div>
                        </div>
                    </div>
                    {{-- Tinggi Berat --}}
                    <div class="card">
                        <div class="card-header">
                            <h5 class="my-1">E. Tinggi dan Berat Badan</h5>
                        </div>
                        <div class="card-block">
                            <div class="col-12 mt-3">
                                <table class="tg-1">
                                    <thead>
                                        <tr>
                                            <th class="tg-a">No</th>
                                            <th class="tg-a">Aspek yang dinilai</th>
                                            <th class="tg-a">Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Tinggi Badan (Cm)</td>
                                            <td>
                                                {{$raport->tinggi_badan  ?? '-'}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Berat Badan (Kg)</td>
                                            <td>
                                                {{$raport->berat_badan  ?? '-'}}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- Kondisi Kesehatan --}}
                    <div class="card">
                        <div class="card-header">
                            <h5 class="my-1">F. Kondisi Kesehatan</h5>
                        </div>
                        <div class="card-block">
                            <div class="col-12 mt-3">
                                <table class="tg-1">
                                    <thead>
                                        <tr>
                                            <th class="tg-a">No</th>
                                            <th class="tg-a">Aspek</th>
                                            <th class="tg-a">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Pendengaran</td>
                                            <td>
                                                {{$raport->kondisi_pendengaran  ?? '-'}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Penglihatan</td>
                                            <td>
                                                {{$raport->kondisi_penglihatan  ?? '-'}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Gigi</td>
                                            <td>
                                                {{$raport->kondisi_gigi  ?? '-'}}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- Prestasi --}}
                    <div class="card">
                        <div class="card-header">
                            <h5 class="my-1">G. Prestasi</h5>
                        </div>
                        <div class="card-block">
                            <div class="col-12 mt-3">
                                <table class="tg-1">
                                    <thead>
                                        <tr>
                                            <th class="tg-a">No</th>
                                            <th class="tg-a">Jenis Prestasi</th>
                                            <th class="tg-a">Tingkat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($prestasi as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $row->nama }}</td>
                                            <td>{{ $row->tingkat }}</td>
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
                        </div>
                        <div class="card-block">
                            <div class="col-12 mt-3">
                                <table class="tg-1">
                                    <thead>
                                        <tr>
                                            <th class="tg-a">Keterangan</th>
                                            <th class="tg-a">Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Sakit</td>
                                            <td>
                                                {{$raport->sakit ?? '-'}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Izin</td>
                                            <td>
                                                {{$raport->izin ?? '-'}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tanpa Keterangan</td>
                                            <td>
                                                {{$raport->tanpa_keterangan ?? '-'}}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="card-header">
                            <h5 class="my-1"></h5>
                        </div>
                        <div class="card-block">
                            <div class="col-12 mt-3">
                                <table class="tg-2">
                                    <thead>
                                    <tr>
                                        <td class="tg-wp8o"></td>
                                        <th class="tg-wp8o">Sungai Ara, {{$tahun_ajaran->tanggal_raport}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="tg-wp8o">Orangtua / Wali</td>
                                        <td class="tg-wp8o">Guru Kelas</td>
                                    </tr>
                                    <tr>
                                        <td class="tg-0lax" colspan="2"></td>
                                    </tr>
                                    <tr>
                                        <td class="tg-0lax" colspan="2"></td>
                                    </tr>
                                    <tr>
                                        <td class="tg-0lax" colspan="2"></td>
                                    </tr>
                                    <tr>
                                        <td class="tg-wp8o">_______________</td>
                                        <td class="tg-wp8o"><strong><u>{{$kelas->wali_kelas->nama}}</u></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="tg-0lax"></td>
                                        <td class="tg-wp8o">NIP. {{$kelas->wali_kelas->nip}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="card-header">
                            <h5 class="my-1"></h5>
                        </div>
                        <div class="card-block">
                            <div class="col-12 mt-3">
                                <table class="tg-3">
                                    <thead>
                                      <tr>
                                        <th class="tg-8g55">Mengetahui</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td class="tg-wp8o">Kepala Sekolah</td>
                                      </tr>
                                      <tr>
                                        <td class="tg-0lax"></td>
                                      </tr>
                                      <tr>
                                        <td class="tg-0lax"></td>
                                      </tr>
                                      <tr>
                                        <td class="tg-0lax"></td>
                                      </tr>
                                      <tr>
                                        <td class="tg-baqh"><strong><u>{{$tahun_ajaran->nama_kepala_sekolah}}</u></strong></td>
                                      </tr>
                                      <tr>
                                        <td class="tg-baqh">NIP. {{$tahun_ajaran->nip_kepala_sekolah}}</td>
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

