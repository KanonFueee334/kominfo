@extends('layout.app')

@section('title', 'Rekapitulasi Absensi')

@section('content')

    <section>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Rekapitulasi</h4>
            </div>
            <div class="card-body">

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