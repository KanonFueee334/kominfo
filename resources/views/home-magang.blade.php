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
                            <a class="btn btn-danger rounded-pill btn-lg">ABSENSI</a>
                        </div>
                        <div>
                            <table class="table table-sm">
                                <tr>
                                    <td>
                                        <h5>Absen Masuk</h5>
                                    </td>
                                    <td>
                                        <h5>:</h5>
                                    </td>
                                    <td>
                                        <h5>07:00</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Absen Pulang</h5>
                                    </td>
                                    <td>
                                        <h5>:</h5>
                                    </td>
                                    <td>
                                        <h5>16:00</h5>
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
                                                    <tr>
                                                        <td class="text-bold-500">Michael Right</td>
                                                        <td>$15/hr</td>
                                                        <td class="text-bold-500">UI/UX</td>

                                                    </tr>
                                                    <tr>
                                                        <td class="text-bold-500">Morgan Vanblum</td>
                                                        <td>$13/hr</td>
                                                        <td class="text-bold-500">Graphic concepts</td>

                                                    </tr>
                                                    <tr>
                                                        <td class="text-bold-500">Tiffani Blogz</td>
                                                        <td>$15/hr</td>
                                                        <td class="text-bold-500">Animation</td>

                                                    </tr>
                                                    <tr>
                                                        <td class="text-bold-500">Ashley Boul</td>
                                                        <td>$15/hr</td>
                                                        <td class="text-bold-500">Animation</td>

                                                    </tr>
                                                    <tr>
                                                        <td class="text-bold-500">Mikkey Mice</td>
                                                        <td>$15/hr</td>
                                                        <td class="text-bold-500">Animation</td>

                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <br/>
                                        <h5 class="text-center"><a href="">Lihat selengkapnya ...</a></h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection