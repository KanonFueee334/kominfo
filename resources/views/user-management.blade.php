@extends('layout.app')

@section('title', 'Pengaturan Pengguna')

@section('content')

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif     

    <section>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Daftar Pengguna</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="user-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < count($users); $i++)
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td>{{ $users[$i]->name }}</td>
                            <td>
                                <span class="badge {{ $users[$i]->status == 1 ? 'bg-success' : 'bg-danger' }} ">
                                    {{ $users[$i]->status == 1 ? 'Aktif' : 'Inaktif' }}
                                </span>
                            </td>
                        </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambah Pengguna</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-horizontal" method="post" action="{{ route('be.um.add') }}">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <label>Username</label>
                                </div>
                                <div class="col-md-10 form-group">
                                    <input type="text" id="username" class="form-control"
                                    name="username" placeholder="Username">
                                </div>
                                <div class="col-md-2">
                                    <label>Password</label>
                                </div>
                                <div class="col-md-10 form-group">
                                    <input type="text" id="password" class="form-control"
                                    name="password" placeholder="Password">
                                </div>
                                <div class="col-md-2">
                                    <label>Nama</label>
                                </div>
                                <div class="col-md-10 form-group">
                                    <input type="text" id="name" class="form-control"
                                    name="name" placeholder="Nama">
                                </div>
                                <div class="col-md-2">
                                    <label>Tgl Lahir</label>
                                </div>
                                <div class="col-md-10 form-group">
                                    <input type="date" id="date-birth" class="form-control"
                                    name="date-birth" placeholder="Tgl Lahir">
                                </div>
                                <div class="col-md-2">
                                    <label>Alamat</label>
                                </div>
                                <div class="col-md-10 form-group">
                                    <input type="text" id="address" class="form-control"
                                    name="address" placeholder="Alamat">
                                </div>
                                <div class="col-md-2">
                                    <label>Telepon</label>
                                </div>
                                <div class="col-md-10 form-group">
                                    <input type="text" id="phone" class="form-control"
                                    name="phone" placeholder="Telepon">
                                </div>
                                <div class="col-md-2">
                                    <label>Institusi</label>
                                </div>
                                <div class="col-md-10 form-group">
                                    <input type="text" id="institution" class="form-control"
                                    name="institution" placeholder="Institusi">
                                </div>
                                <div class="col-sm-12 d-flex justify-content-end">
                                    <button type="submit"
                                    class="btn btn-primary me-1 mb-1">Simpan</button>
                                    <button type="reset"
                                    class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>

@endsection