@extends('layout.app')

@section('title', 'Beranda')

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-12 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Senin, 17 Agustus 2024</h4>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-secondary text-center">
                            <h5>Klik Untuk Absensi</h5>
                            <form method="post" action="{{ route('mg.absen.save') }}">
                                @csrf
                                <button type="submit" class="btn btn-danger rounded-pill btn-lg">ABSENSI</button>
                            </form> 
                        </div>
                            <!-- Display success message -->
                            @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                            @endif

                            <!-- Display Validation Errors -->
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    Gagal menyimpan absensi
                                </div>
                            @endif  
                        <div>
                            <table class="table table-sm" style="font-size: 1.25rem; font-weight: 700;">
                               
                                <tr>
                                    <td>
                                        Absen Masuk
                                    </td>
                                    <td>
                                        :
                                    </td>
                                    <td>
                                        @if(!empty($absensiToday[0]->masuk))
                                            {{ $absensiToday[0]->masuk }}
                                        @else
                                            --
                                        @endif
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>
                                        Absen Pulang
                                    </td>
                                    <td>
                                        :
                                    </td>
                                    <td>
                                        @if(!empty($absensiToday[0]->pulang))
                                            {{ $absensiToday[0]->pulang }}
                                        @else
                                            --
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Riwayat Absensi</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-lg">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>TANGGAL</th>
                                        <th>WAKTU</th>
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
                    <br/>
                    <h5 class="text-center"><a href="{{ route('mg.absen.history') }}">Lihat selengkapnya ...</a></h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection