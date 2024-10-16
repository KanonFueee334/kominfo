@extends('layout.app')

@section('title', 'Riwayat Absensi')

@section('content')

    <section>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Riwayat</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="absensi-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < count($absenList); $i++)
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td>{{ $absenList[$i]->tgl }}</td>
                            <td>{{ $absenList[$i]->waktu }}</td>
                        </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>

    </section>

@endsection