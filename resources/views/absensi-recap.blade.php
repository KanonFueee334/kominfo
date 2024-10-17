@extends('layout.app')

@section('title', 'Rekapitulasi Absensi')

@section('content')

    <section>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Rekapitulasi</h4>
            </div>
            <div class="card-body">
                <form class="form form-horizontal" method="post" action="{{ route('mg.recap.m') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Tahun</h6>
                            <fieldset class="form-group">
                                <select class="form-select" id="slc-year" name="input-year">
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                    <option value="2026">2026</option>
                                    <option value="2027">2027</option>
                                    <option value="2028">2028</option>
                                </select>
                            </fieldset>
                        </div>  
                        <div class="col-md-6">
                            <h6>Bulan</h6>
                            <fieldset class="form-group">
                                <select class="form-select" id="slc-month" name="input-month">
                                    <option value="1" {{ old('input-month') == 1 ? 'selected' : '' }}>Januari</option>
                                    <option value="2" {{ old('input-month') == 2 ? 'selected' : '' }}>Februari</option>
                                    <option value="3" {{ old('input-month') == 3 ? 'selected' : '' }}>Maret</option>
                                    <option value="4" {{ old('input-month') == 4 ? 'selected' : '' }}>April</option>
                                    <option value="5" {{ old('input-month') == 5 ? 'selected' : '' }}>Mei</option>
                                    <option value="6" {{ old('input-month') == 6 ? 'selected' : '' }} >Juni</option>
                                    <option value="7" {{ old('input-month') == 7 ? 'selected' : '' }}>Juli</option>
                                    <option value="8" {{ old('input-month') == 8 ? 'selected' : '' }}>Agustus</option>
                                    <option value="9" {{ old('input-month') == 9 ? 'selected' : '' }}>September</option>
                                    <option value="10" {{ old('input-month') == 10 ? 'selected' : '' }}>Oktober</option>
                                    <option value="11" {{ old('input-month') == 11 ? 'selected' : '' }}>November</option>
                                    <option value="12" {{ old('input-month') == 12 ? 'selected' : '' }}>Desember</option>
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-sm-12 d-flex justify-content-end">
                            <button type="submit"
                            class="btn btn-success me-1 mb-1">Tampilkan</button>
                        </div>
                    </div>
                </form>

                <hr/>

                <table class="table table-striped" id="absensi-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Masuk</th>
                            <th>Pulang</th>
                            <th>Terlambat</th>
                            <th>Cepat Pulang</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < count($data); $i++)
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td>{{ $data[$i]->tgl }}</td>
                            <td>
                                @if(empty($data[$i]->masuk))
                                    -
                                @else
                                    {{ $data[$i]->masuk }}
                                @endif
                            </td>
                            <td>
                                @if(empty($data[$i]->pulang))
                                    -
                                @else
                                    {{ $data[$i]->pulang }}
                                @endif
                            </td>
                            <td>
                                @if(empty($data[$i]->terlambat))
                                    -
                                @else
                                    {{ $data[$i]->terlambat }}
                                @endif
                            </td>
                            <td>@if(empty($data[$i]->cepat_pulang))
                                    -
                                @else
                                    {{ $data[$i]->cepat_pulang }}
                                @endif
                            </td>
                            <td>
                                @if(empty($data[$i]->masuk) && empty($data[$i]->pulang))
                                    Tidak Absen
                                @endif
                            </td>
                        </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>

    </section>

@endsection